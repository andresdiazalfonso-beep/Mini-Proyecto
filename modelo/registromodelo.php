<?php
function sanear($datos){
    return htmlspecialchars(trim($datos));
}

function validar_datos($datos){
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


    //Validar si no existen correos iguales
    $sql = "SELECT id FROM usuarios WHERE email = ?";


}

?>