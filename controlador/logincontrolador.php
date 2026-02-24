<?php
session_start();
require_once "../Conexion/conexion.php";
require_once "../modelo/logincontrolador.php";

if ($_SERVER['REQUEST_METHOD'] === "POST"){
    $email = sanear($_POST);
    $password = sanear($_POST);

    $usuario = buscar_email($email,$conexion);

    if($usuario){

        //Verificar Contraseña
        



    }
}

?>