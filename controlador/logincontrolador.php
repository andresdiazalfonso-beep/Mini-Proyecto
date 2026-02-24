<?php
session_start();
require_once "../Conexion/conexion.php";
require_once "../modelo/loginmodelo.php";

if ($_SERVER['REQUEST_METHOD'] === "POST"){
    $email = sanear($_POST['email']);
    $password = sanear($_POST['password']);

    $usuario = obtener_datos($email,$conexion);

    if($usuario){

        //Verificar Contraseña
        if(password_verify($password, $usuario['password'])){
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            header("Location: ../pages/index.php");
            exit();
        }else{
            echo "<script>alert('Contraseña incorrecta'); window.location.href='../pages/login.php';</script>";
        }
    }else{
        echo "<script>alert('Email no registrado'); window.location.href='../pages/login.php';</script>";
    }
}

?>