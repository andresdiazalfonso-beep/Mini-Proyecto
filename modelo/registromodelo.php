<?php
function sanear($datos){
    return htmlspecialchars(trim($datos));
}

function validar_datos($datos, $conexion){
    $errores = [];

    if(strlen($datos['nombre']) < 4){
        $errores[] = "El nombre debe tener al menos 4 caracteres";
    }

    if(!filter_var($datos['email'],FILTER_VALIDATE_EMAIL)){
        $errores[] = "El correo no tiene formato";
    }

    if(strlen($datos['password']) < 6){
        $errores[] = "La contraseña debe tener al menos 6 caracteres";
    }

    if($datos['password'] !== $datos['password_confirm']){
        $errores[] = "Las contraseñas no coinciden";
    }

    //Validar si existe ya el email
    $sql = "SELECT id FROM usuarios WHERE email = ?";
    $stmt = mysqli_prepare($conexion, $sql);

    if($stmt){
        mysqli_stmt_bind_param($stmt, "s", $datos['email']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if(mysqli_stmt_num_rows($stmt) > 0){
            $errores[] = "El correo ya está registrado";
        }

        mysqli_stmt_close($stmt);
    }

    return $errores;
}


function guardar_registro($conexion, $datos){
    $verificar_tabla = "SHOW TABLE LIKE 'usuariosa'";
    $resultado = mysqli_query($conexion,$verificar_tabla);

    if(mysqli_num_rows($resultado) == 0){
        $crear_tabla_usuarios = "CREATE TABLE usuarios (
            id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        mysqli_query($conexion,$crear_tabla_usuarios);
    }


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