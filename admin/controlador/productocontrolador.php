<?php
session_start();
require_once "../modelo/ProductosModelo.php";
require_once "../../conexion/Conexion.php";

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header("Location: /pages/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $pdo    = Conexion::conectar();
    $modelo = new ProductoModelo($pdo);

    $accion      = htmlspecialchars(trim($_POST['accion']));
    $id_producto = intval($_POST['id_producto']);

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

    if ($accion === "eliminar") {
        $modelo->eliminarProducto($id_producto);
        $_SESSION['mensaje'] = "Producto eliminado correctamente";
        header("Location: productocontrolador.php");
        exit();
    }

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

header("Location: ../vista/adminproductos.php");
exit();
?>