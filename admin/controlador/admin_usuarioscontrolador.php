<?php
session_start();
require_once "../modelo/usuariosmodelo.php";
require_once "../../Conexion/conexion.php";

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header("Location: /pages/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $pdo    = Conexion::conectar();
    $modelo = new UsuariosModelo($pdo);

    $accion     = htmlspecialchars(trim($_POST['accion']));
    $id_usuario = intval($_POST['id_usuario']);

    if ($accion === "editar") {
        $nombre = htmlspecialchars(trim($_POST['nombre']));
        $email  = htmlspecialchars(trim($_POST['email']));
        $rol    = in_array($_POST['rol'], ['admin', 'usuario']) ? $_POST['rol'] : 'usuario';

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['mensaje'] = "El correo no tiene un formato válido";
            header("Location: ../vista/adminusuarios.php");
            exit();
        }

        if ($modelo->emailExiste($email, $id_usuario)) {
            $_SESSION['mensaje'] = "El correo ya está en uso por otro usuario";
            header("Location: ../vista/adminusuarios.php");
            exit();
        }

        $modelo->actualizarUsuario($id_usuario, $nombre, $email, $rol);
        $_SESSION['mensaje'] = "Usuario actualizado correctamente";
        header("Location: admin_usuarioscontrolador.php");
        exit();
    }

    if ($accion === "eliminar") {
        // Evitar que el admin se elimine a sí mismo
        if ($id_usuario === intval($_SESSION['usuario']['id_usuario'])) {
            $_SESSION['mensaje'] = "No puedes eliminar tu propia cuenta de administrador";
            header("Location: ../vista/adminusuarios.php");
            exit();
        }

        $modelo->eliminarUsuario($id_usuario);
        $_SESSION['mensaje'] = "Usuario eliminado correctamente";
        header("Location: admin_usuarioscontrolador.php");
        exit();
    }
}

require_once "../vista/adminusuarios.php";
?>
