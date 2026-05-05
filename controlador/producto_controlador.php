<?php
require_once "/Conexion/conexion.php";
require_once "/modelo/Producto.php";
require_once "/modelo/Carrito.php";
require_once "/Helpers/Helpers.php";

session_start();


if (!isset($_SESSION['usuario'])) {
    header("Location: /pages/login.php");
    exit();
}


if(!isset($_SESSION['carrito'])){
    $_SESSION['carrito'] = new Carrito();
}

$carrito = $_SESSION['carrito'];


$conexion = Conexion::conectar();

try{
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $accion = $_POST['accion'] ?? "";

    if($accion === "añadir"){
        $id = Helpers::sanear($_POST['producto_id']);
        $cantidad = Helpers::sanear($_POST['cantidad']);

        $stmt=$conexion->prepare("SELECT * FROM productos WHERE id_producto = :id");
        $stmt->execute([
            ":id" => $id
        ]);

        $datos = $stmt->fetch();

        $producto = new Producto($datos);
        $carrito->añadirCarrito($producto, $cantidad);

            $_SESSION['carrito'] = $carrito;
            $_SESSION['mensaje'] = "Producto añadido al carrito.";
            header("Location: producto_controlador.php");
            exit();
    }       
            
    if(isset($_POST['vaciar'])){
        $carrito->vaciarCarrito();
        $_SESSION['carrito'] = $carrito;
        $_SESSION['mensaje'] = "Carrito vaciado.";
        header("Location: controlador_cliente.php");
        exit();
    }


    if(isset($_POST['checkout'])){
        $id_usuario = $_SESSION['usuario']['id_usuario'];
        
        if ($carrito->checkout($conexion, $id_usuario)){
            $_SESSION['mensaje'] =  "Compra realizada con éxito";
            header("Location: controlador_cliente.php");
            exit();
        } else {
            $_SESSION['errores'][] = "Error al procesar la compra";
            header("Location: controlador_cliente.php");
            exit();
        }
    }

}

}catch(PDOException $e){
    $_SESSION['errores'][] = $e->getMessage();
    header("Location: controlador_cliente.php");
    exit();
}


include "/pages/producto.php";



?>