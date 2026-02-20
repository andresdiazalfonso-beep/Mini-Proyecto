<?php
session_start();

require_once "../modelo/registromodelo.php";

if($_SERVER['REQUEST_METHOD'] === "POST"){

    $datos = [
        "nombre" => sanear($_POST['nombre']),
        "email" => sanear($_POST['email']),
        "password" => sanear($_POST['password']),
        "password_confirm" => sanear($_POST[['password_confirm']])
    ];

    $errores = validar($datos);

    if(empty($errores)){
        
    }
}

?>