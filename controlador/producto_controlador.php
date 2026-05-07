<?php
require_once "../Conexion/conexion.php";
require_once "../modelo/Producto.php";
require_once "../modelo/Carrito.php";
require_once "../Helpers/Helpers.php";

session_start();


if(!isset($_SESSION['carrito'])){
    $_SESSION['carrito'] = new Carrito();
}

$carrito = $_SESSION['carrito'];


$conexion = Conexion::conectar();

try{
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        if (!isset($_SESSION['usuario'])) {
            $_SESSION['error_login'] = "Debes iniciar sesion antes de donar";
            
            header("Location: /pages/login.php");
            exit();
        }

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
        $carrito->añadirCarrito($producto, 1);

            $_SESSION['carrito'] = $carrito;
            $_SESSION['mensaje'] = "Producto añadido al carrito.";

            header("Location: producto_controlador.php");
            exit();
    }       
            
    if($accion === "eliminar"){
        $id = Helpers::sanear($_POST['producto_id']);

        $carrito->eliminarProducto($id);

        $_SESSION['carrito'] = $carrito;
        $_SESSION['mensaje'] = "Producto eliminado del carrito";

        header("Location: producto_controlador.php");
        exit();
    }


    if($accion == "checkout"){
        if (empty($_SESSION['carrito']->getCarrito())) {
            $_SESSION['errores'][] = "El carrito está vacío";
            header("Location: producto_controlador.php");
            exit();
        }
        

        header("Location: stripe_checkout.php");
        exit();
    }

}

}catch(Exception $e){
    $_SESSION['errores'][] = $e->getMessage();
    header("Location: producto_controlador.php");
    exit();
}


include "../pages/producto.php";



?>