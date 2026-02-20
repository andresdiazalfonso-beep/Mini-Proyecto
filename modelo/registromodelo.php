<?php
function sanear($datos){
    return htmlspecialchars(trim($datos));
}

function validar_datos($datos,$conexion){
    $errores = [];

    if(empty($datos['nombre']) || empty($datos['email'])  || empty($datos['password']) || empty($datos['password_confirm'])){
        $errores[] = "Todos los campos son obligatorios";
    }

    if(strlen($datos['nombre']) < 4){
        $errores[] = "El nombre debe tener almenos 4 caracteres";
    }

    if(!filter_var($datos['email'],FILTER_VALIDATE_EMAIL)){
        $errores[] = "El correo no tiene formato";
    }

    if(strlen($datos['password']) < 6){
        $errores[] = "La contraseña debe tener almenos 6 caracteres";
    }


    if($datos['password'] !== $datos['password_confirm']){
        $errores[] = "Las contraseñas no coinciden";
    }

    //validar si existe email en la base de datos
    $sql = "SELECT id FROM usuarios WHERE email = ?";
    $resultado = mysqli_prepare($conexion,$sql);
    
    if($resultado){
        mysqli_stmt_bind_param($resultado,"s",$datos['email']);
        mysqli_execute($resultado);
        mysqli_store_result($resultado);

        if(mysqli_stmt_num_rows($resultado) > 0){
            $errores[] = "El correo ya esta registrado";
        }
    }
    mysqli_stmt_close($resultado);


    return $errores;
}

function guardar_registro($conexion,$datos){
    $sql = "INSERT INTO usuarios (nombre,email,password) VALUES (?,?,?)";
    $resultado = mysqli_prepare($sql);
    mysqli_stmt_bind_param($resultado,"sss",$datos['nombre'],$datos['email'],$datos['password']);

    if(mysqli_execute($resultado)){
        mysqli_stmt_close($resultado);
        return true;
    }else{
        mysqli_stmt_close($resultado);
        return false;
    }
}

?>