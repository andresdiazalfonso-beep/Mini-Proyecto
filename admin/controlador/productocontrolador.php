<?php
session_start();
require_once "../modelo/productosmodelo.php";
require_once "../../Conexion/conexion.php";


if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: /login.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] === "POST"){
    $accion = htmlspecialchars(trim($_POST['accion']));
    $id_producto = intval($_POST['id_producto']);

    if($accion === "agregar"){

        //Guardamos la imagen que queremos ingresar en una variable
        $imagen = file_get_contents($_FILES['imagen']['tmp_name']);

        //Guardamos todos los datos, para despues pasarlos por la funcion para que se inserten en la base de dato
        $nombre = htmlspecialchars(trim($_POST['nombre']));
        $descripcion = htmlspecialchars(trim($_POST['descripcion']));
        $precio = intval($_POST['precio']);

        agregarProducto(
            $conexion,
            $nombre,
            $descripcion,
            $precio,
            $imagen
        );

        //Una vez hecha la funcion se enviara a la vista con un mensaje
        $_SESSION['mensaje'] = "Producto agregado correctamente";
        header("Location: ../vista/adminproductos.php");
        exit();
    }

    if($accion === "eliminar"){
        eliminarProducto($conexion,$id_producto);
        $_SESSION['mensaje'] = "Producto eliminado correctamente";
        header("Location: ../vista/adminProductos.php");
        exit();
    }

    if($accion === "editar"){
        //Si esta vacio la imagen nueva guardamos la imagen que tenia ya que no quiere cambiarla
        if(empty($_FILES['imagen']['tmp_name'])){
            $imagen = base64_decode($_POST['imagen_actual']);
        }else{
            //Si existe la imagen nueva se guardara para reemplazar por la antigua
            $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
        }

        //Guardamos los datos del formulario para luego pasarlo en la funcion
        $nombre = htmlspecialchars(trim($_POST['nombre']));
        $precio = intval($_POST['precio']);
        $descripcion = htmlspecialchars(trim($_POST['descripcion']));

        actualizarProducto(
            $conexion,
            $id_producto,
            $nombre,
            $descripcion,
            $precio,
            $imagen
        );

        //Una vez hecha la funcion se enviara a la vista con un mensaje
        $_SESSION['mensaje'] = "Producto actualizado correctamente";
        header("Location: ../vista/adminproductos.php");
        exit();
    }
}
header("Location: ../vista/adminproductos.php");
exit();
?>