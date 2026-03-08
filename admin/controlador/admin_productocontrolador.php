<?php
session_start();
require_once "../modelo/productosmodelo.php";
require_once "../../Conexion/conexion.php";

$productos = obtenerProductos($conexion);

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if($_POST['accion'] === "agregar"){
        $imagen = $_FILES['imagen']['name'];
        move_uploaded_file($_FILES['imagen']['tmp_name'], "../../assets/imagenes/".$imagen);

        agregarProducto(
            $conexion,
            $_POST['nombre'],
            $_POST['descripcion'],
            $_POST['precio'],
            $imagen,
            $_POST['stock']
        );
        header("Location: ../adminProductos.php");
        exit();
    }

    if($_POST['accion'] === "eliminar"){
        eliminarProducto($conexion,$_POST['id_producto']);
        header("Location: ../adminProductos.php");
        exit();
    }

    if($_POST['accion'] === "actualizar"){
        $imagen = $_FILES['imagen']['name'];
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
            $imagen,
            $_POST['stock']
        );
        header("Location: ../adminProductos.php");
        exit();
    }
}
?>