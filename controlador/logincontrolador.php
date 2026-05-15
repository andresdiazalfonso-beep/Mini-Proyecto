<?php
session_start();
require_once "../Conexion/conexion.php";
require_once "../modelo/Loginmodelo.php";

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $pdo = Conexion::conectar();
    $modelo = new LoginModelo($pdo);

    $email    = $modelo->sanear($_POST['email']);
    $password = $modelo->sanear($_POST['password']);

    $usuario = $modelo->obtener_datos($email);

    if ($usuario) {
        if (password_verify($password, $usuario['password'])) {
            $_SESSION['usuario'] = $usuario;

            if (isset($_POST['recordar'])) {
                setcookie('recordar_email', $email,    time() + (30 * 24 * 60 * 60), "/");
            } else {
                setcookie("recordar_email","", time() - 3600, "/");
                setcookie("recordar_password", "", time() - 3600, "/");
            }

            if($_SESSION['usuario']['rol'] == 'admin'){
                header("Location: /admin/vista/admin_estadisticas.php");
                exit();
            }else{
                header("Location: /pages/index.php");
                exit();
            }
        } else {
            $errores['password'] = "Contraseña Incorrecta";
        }
    } else {
        $errores['email'] = "Correo electrónico no registrado";
    }

    $_SESSION['errores'] = $errores;
}

header("Location: ../pages/login.php");
exit();
?>