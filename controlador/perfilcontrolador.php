<?php
session_start();

// Solo usuarios logueados pueden acceder
if (!isset($_SESSION['usuario'])) {
    header("Location: ../pages/login.php");
    exit();
}

require_once "../conexion/Conexion.php";
require_once "../modelo/PerfilModelo.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../pages/perfil.php");
    exit();
}

$pdo    = Conexion::conectar();
$modelo = new PerfilModelo($pdo);

$idUsuario = (int) $_SESSION['usuario']['id_usuario'];
$nombre    = $modelo->sanear($_POST['nombre'] ?? '');
$email     = $modelo->sanear($_POST['email'] ?? '');

$errores = $modelo->validar(['nombre' => $nombre, 'email' => $email], $idUsuario);

if (!empty($errores)) {
    $_SESSION['perfil_errores'] = $errores;
    header("Location: ../pages/perfil.php");
    exit();
}

$actualizado = $modelo->actualizar($idUsuario, $nombre, $email);

if ($actualizado) {
    // Refrescar datos de sesión
    $usuarioActualizado = $modelo->obtenerPorId($idUsuario);
    if ($usuarioActualizado) {
        $_SESSION['usuario']['nombre'] = $usuarioActualizado['nombre'];
        $_SESSION['usuario']['email']  = $usuarioActualizado['email'];
    }
    $_SESSION['perfil_exito'] = "Perfil actualizado correctamente.";
} else {
    $_SESSION['perfil_errores'] = ['general' => "No se pudo actualizar el perfil. Inténtalo de nuevo."];
}

header("Location: ../pages/perfil.php");
exit();
?>