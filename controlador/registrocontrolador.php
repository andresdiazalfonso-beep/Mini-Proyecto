<?php
session_start();
require_once "../Conexion/conexion.php";
require_once "../modelo/Registromodelo.php";

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $pdo    = Conexion::conectar();
    $modelo = new RegistroModelo($pdo);

    $datos = [
        "nombre"           => $modelo->sanear($_POST['nombre']),
        "email"            => $modelo->sanear($_POST['email']),
        "password"         => $modelo->sanear($_POST['password']),
        "password_confirm" => $modelo->sanear($_POST['password_confirm'])
    ];

    $errores = $modelo->validar_datos($datos);
    $_SESSION['errores'] = $errores;

    if (empty($errores)) {
        $resultado = $modelo->guardar_registro($datos);

        if ($resultado) {
            header("Location: ../pages/login.php");
            exit();
        } else {
            $_SESSION['errores'][] = "Error al registrar al usuario";
            header("Location: ../pages/registro.php");
            exit();
        }
    }
}

header("Location: ../pages/registro.php");
exit();
?>