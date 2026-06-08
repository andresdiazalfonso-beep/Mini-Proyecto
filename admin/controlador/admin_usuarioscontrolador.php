<?php
session_start();

/**
 * Controlador para la administración de usuarios (edición y eliminación) exclusivo para el rol de administrador
 */
require_once "../modelo/UsuariosModelo.php";
require_once "../../conexion/Conexion.php";

/**
 * Control de acceso: Restringe el paso si el usuario no ha iniciado sesión o no tiene rango de administrador
 */
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header("Location: /pages/login.php");
    exit();
}

/**
 * Procesamiento de acciones de gestión enviadas mediante el método POST
 */
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $pdo    = Conexion::conectar();
    $modelo = new UsuariosModelo($pdo);

    // Saneamiento y tipado de los parámetros de acción e identificación de usuario
    $accion     = htmlspecialchars(trim($_POST['accion']));
    $id_usuario = intval($_POST['id_usuario']);

    /**
     * Sección encargada de la actualización de los datos de un usuario
     */
    if ($accion === "editar") {
        $nombre = htmlspecialchars(trim($_POST['nombre']));
        $email  = htmlspecialchars(trim($_POST['email']));
        $rol    = in_array($_POST['rol'], ['admin', 'usuario']) ? $_POST['rol'] : 'usuario';

        // Validación de estructura del formato de email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['mensaje'] = "El correo no tiene un formato válido";
            header("Location: ../vista/adminusuarios.php");
            exit();
        }

        // Validación para evitar que se asigne un email que ya pertenece a otra cuenta
        if ($modelo->emailExiste($email, $id_usuario)) {
            $_SESSION['mensaje'] = "El correo ya está en uso por otro usuario";
            header("Location: ../vista/adminusuarios.php");
            exit();
        }

        // Aplica los cambios y redirige de vuelta al flujo principal del controlador
        $modelo->actualizarUsuario($id_usuario, $nombre, $email, $rol);
        $_SESSION['mensaje'] = "Usuario actualizado correctamente";
        header("Location: admin_usuarioscontrolador.php");
        exit();
    }

    /**
     * Sección encargada de dar de baja o eliminar un usuario del sistema
     */
    if ($accion === "eliminar") {
        // Evitar que el admin se elimine a sí mismo
        if ($id_usuario === intval($_SESSION['usuario']['id_usuario'])) {
            $_SESSION['mensaje'] = "No puedes eliminar tu propia cuenta de administrador";
            header("Location: ../vista/adminusuarios.php");
            exit();
        }

        // Ejecuta la baja del registro y redirige para refrescar el listado
        $modelo->eliminarUsuario($id_usuario);
        $_SESSION['mensaje'] = "Usuario eliminado correctamente";
        header("Location: admin_usuarioscontrolador.php");
        exit();
    }
}

/**
 * Carga de la vista de administración
 */
require_once "../vista/adminusuarios.php";
?>