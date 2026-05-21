<?php
session_start();

require_once "../conexion/Conexion.php";
require_once "../modelo/ContactoModelo.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../pages/contacto.php");
    exit();
}

$pdo    = Conexion::conectar();
$modelo = new ContactoModelo($pdo);

$datos = [
    'nombre'  => $modelo->sanear($_POST['nombre']  ?? ''),
    'email'   => $modelo->sanear($_POST['email']   ?? ''),
    'asunto'  => $modelo->sanear($_POST['asunto']  ?? ''),
    'mensaje' => $modelo->sanear($_POST['mensaje'] ?? ''),
];

$errores = $modelo->validar($datos);

if (!empty($errores)) {
    $_SESSION['contacto_errores'] = $errores;
    $_SESSION['contacto_datos']   = $datos;
    header("Location: ../pages/contacto.php");
    exit();
}

$resultado = $modelo->guardar($datos);

if ($resultado) {
    $_SESSION['contacto_exito'] = "¡Mensaje enviado correctamente! Te responderemos lo antes posible.";
} else {
    $_SESSION['contacto_errores'] = ['general' => "Error al enviar el mensaje. Inténtalo de nuevo."];
}

header("Location: ../pages/contacto.php");
exit();
?>