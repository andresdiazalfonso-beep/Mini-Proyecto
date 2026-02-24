<?php
session_start();
require_once "../Conexion/conexion.php";
require_once "../modelo/loginmodelo.php";

$errores = [];
if ($_SERVER['REQUEST_METHOD'] === "POST"){
    $email = sanear($_POST['email']);
    $password = sanear($_POST['password']);

    $usuario = obtener_datos($email,$conexion);

    if($usuario){

        //Verificar Contraseña
        if(password_verify($password, $usuario['password'])){
            $_SESSION['id_usuario'] = $usuario['id_usuario'];

            // Si marca "Recordar", crea las cookies
            if(isset($_POST['recordar'])){
                setcookie('recordar_email',$email,time() + (30*24*60*60), "/");
                setcookie('recordar_password',$password,time() + (30*24*60*60), "/");
            }else {
                // Si desmarca "Recordar", borrar cookies si existen
                setcookie("recordar_email", "", time() - 3600, "/");
                setcookie("recordar_password", "", time() - 3600, "/");
            }
            
            header("Location: ../pages/index.php");
            exit();

        }else{
            $errores['password'] = "Contraseña Incorrecta";
        }
    }else{
       $errores['email'] = "Correo electrónico no registrado";
    }

    $_SESSION['errores'] = $errores;
}
header("Location: ../pages/login.php");
exit();

?>