<?php
session_start();
require_once "../modelo/productosmodelo.php";
require_once "../../Conexion/conexion.php";

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if($_POST['accion'] === "agregar"){

        $imagen = file_get_contents($_FILES['imagen']['tmp_name']);

        agregarProducto(
            $conexion,
            $_POST['nombre'],
            $_POST['descripcion'],
            $_POST['precio'],
            $imagen
        );
        $_SESSION['mensaje'] = "Producto agregado correctamente";
        header("Location: ../vista/adminproductos.php");
        exit();
    }

    if($_POST['accion'] === "eliminar"){
        eliminarProducto($conexion,$_POST['id_producto']);
        $_SESSION['mensaje'] = "Producto eliminado correctamente";
        header("Location: ../vista/adminProductos.php");
        exit();
    }

    if($_POST['accion'] === "editar"){
        $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
        if($imagen != ""){
            move_uploaded_file($_FILES['imagen']['tmp_name'], "../../assets/imagenes/".$imagen);
        } else {
            $imagen = $_POST['imagen_actual'];
        }

        actualizarProducto(
            $conexion,
            $_POST['id_producto'],
            $_POST['nombre'],
            $_POST['descripcion'],
            $_POST['precio'],
            $imagen
        );

        $_SESSION['mensaje'] = "Producto actualizado correctamente";
        header("Location: ../vista/adminproductos.php");
        exit();
    }
}
?>