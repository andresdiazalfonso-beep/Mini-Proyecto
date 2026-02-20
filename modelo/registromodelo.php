<?php
function sanear($datos){
    return htmlspecialchars(trim($datos));
}

function validar_datos($datos){
    $errores = [];

    if(empty($datos['nombre'])){
        $errores[] = "El nombre esta vacio";
    }
    if(strlen($datos['nombre']) < 4){
        $errores[] = "El nombre debe tener almenos 4 caracteres";
    }


    if(empty($datos['email'])){
        $errores[] = "El correo electronico esta vacio";
    }
    if(!filter_var($datos['email'],FILTER_VALIDATE_EMAIL)){
        $errores[] = "El correo no tiene formato";
    }

    if(empty($datos['password'])){
        $errores[] = "La contraseña esta vacia";
    }
    if(strlen($datos['password']) < 4){
        $errores[] = "La contraseña debe tener almenos 4 caracteres";
    }

}

?>