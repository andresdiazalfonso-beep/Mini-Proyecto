<?php
session_start();
require_once "../modelo/ProductosModelo.php";
require_once "../../conexion/Conexion.php";

/**
 * Verifica que el usuario haya iniciado sesión y tenga el rol de administrador
 */
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header("Location: /pages/login.php");
    exit();
}

/**
 * Procesa las operaciones del catálogo si la petición es de tipo POST
 */
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $pdo    = Conexion::conectar();
    $modelo = new ProductoModelo($pdo);

    $accion      = htmlspecialchars(trim($_POST['accion']));
    $id_producto = intval($_POST['id_producto']);

    /**
     * Registra un nuevo producto con su correspondiente imagen
     */
    if ($accion === "agregar") {
        $imagen      = file_get_contents($_FILES['imagen']['tmp_name']);
        $nombre      = htmlspecialchars(trim($_POST['nombre']));
        $descripcion = htmlspecialchars(trim($_POST['descripcion']));
        $precio      = intval($_POST['precio']);

        $modelo->agregarProducto($nombre, $descripcion, $precio, $imagen);

        $_SESSION['mensaje'] = "Producto agregado correctamente";
        header("Location: productocontrolador.php");
        exit();
    }

    /**
     * Elimina un producto del catálogo mediante su ID
     */
    if ($accion === "eliminar") {
        $modelo->eliminarProducto($id_producto);
        $_SESSION['mensaje'] = "Producto eliminado correctamente";
        header("Location: productocontrolador.php");
        exit();
    }

    /**
     * Modifica los datos de un producto, controlando si se actualiza o conserva la imagen
     */
    if ($accion === "editar") {
        if (empty($_FILES['imagen']['tmp_name'])) {
            $imagen = base64_decode($_POST['imagen_actual']);
        } else {
            $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
        }

        $nombre      = htmlspecialchars(trim($_POST['nombre']));
        $precio      = intval($_POST['precio']);
        $descripcion = htmlspecialchars(trim($_POST['descripcion']));

        $modelo->actualizarProducto($id_producto, $nombre, $descripcion, $precio, $imagen);

        $_SESSION['mensaje'] = "Producto actualizado correctamente";
        header("Location: productocontrolador.php");
        exit();
    }
}

/**
 * Redirige a la vista principal de administración si no se procesó ninguna acción por POST
 */
header("Location: ../vista/adminproductos.php");
exit();
?>