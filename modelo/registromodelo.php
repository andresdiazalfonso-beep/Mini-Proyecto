<?php
function sanear($datos){
    return htmlspecialchars(trim($datos));
}

function validar_datos($datos, $conexion){
    $errores = [];

    if(strlen($datos['nombre']) < 4){
        $errores['nombre'] = "El nombre debe tener al menos 4 caracteres";
    }

    if(!filter_var($datos['email'],FILTER_VALIDATE_EMAIL)){
        $errores['email'] = "El correo no tiene formato";
    }

    if(strlen($datos['password']) < 6){
        $errores['password'] = "La contraseña debe tener al menos 6 caracteres";
    }

    if($datos['password'] !== $datos['password_confirm']){
        $errores['password_confirm'] = "Las contraseñas no coinciden";
    }

    //Validar si existe ya el email
    $sql = "SELECT 1 FROM usuarios WHERE email = ?";
    $stmt = mysqli_prepare($conexion, $sql);

    if($stmt){
        mysqli_stmt_bind_param($stmt, "s", $datos['email']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if(mysqli_stmt_num_rows($stmt) > 0){
            $errores['email'] = "El correo ya está registrado";
        }

        mysqli_stmt_close($stmt);
    }

    return $errores;
}


function guardar_registro($conexion, $datos){
    $sql = "INSERT INTO usuarios (nombre,email,password) VALUES (?,?,?)";
    $stmt = mysqli_prepare($conexion, $sql);

    if($stmt){
        mysqli_stmt_bind_param($stmt, "sss", $datos['nombre'], $datos['email'], $datos['password']);

        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_close($stmt);
            return true;
        } else {
            mysqli_stmt_close($stmt);
            return false;
        }
    } else {
        return false;
    }
}


?>