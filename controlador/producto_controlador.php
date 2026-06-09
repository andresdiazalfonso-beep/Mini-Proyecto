<?php
/**
 * Inclusión de: conexión, modelos y utilidades auxiliares
 */
require_once "../conexion/Conexion.php";
require_once "../modelo/Producto.php";
require_once "../modelo/Carrito.php";
require_once "../Helpers/Helpers.php";

/**
 * Inicialización de la sesión
 */
session_start();

<<<<<<< HEAD

=======
/**
 * Control de acceso global: Redirige a la pantalla de login si el usuario no ha iniciado sesión
 */
if (!isset($_SESSION['usuario'])) {
    header("Location: ../pages/login.php");
    exit;
}

/**
 * Inicialización del carrito: Crea una nueva instancia de la clase Carrito en la sesión si no existe previamente
 */
>>>>>>> 948df8222a856942d13a81a7a69f56f47af059cc
if(!isset($_SESSION['carrito'])){
    $_SESSION['carrito'] = new Carrito();
}

/**
 * Recupera la instancia del carrito guardada en la sesión actual
 */
$carrito = $_SESSION['carrito'];

/**
 * Establece la conexión PDO activa con la base de datos
 */
$conexion = Conexion::conectar();

try{
    /**
     * Captura y procesamiento de las operaciones del carrito enviadas por POST
     */
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        
        /**
         * Verificación redundante de seguridad para forzar el inicio de sesión antes de interactuar
         */
        if (!isset($_SESSION['usuario'])) {
            $_SESSION['error_login'] = "Debes iniciar sesion antes de donar";
            
            header("Location: /pages/login.php");
            exit();
        }

        // Obtiene la acción específica solicitada desde el formulario
        $accion = $_POST['accion'] ?? "";

    /**
     * Caso de uso: Añadir un producto al carrito de compras
     */
    if($accion === "añadir"){
        // Sanea los datos del identificador y la cantidad recibidos
        $id = Helpers::sanear($_POST['producto_id']);
        $cantidad = Helpers::sanear($_POST['cantidad']);

        // Consulta los detalles del artículo en la base de datos mediante su ID
        $stmt=$conexion->prepare("SELECT * FROM productos WHERE id_producto = :id");
        $stmt->execute([
            ":id" => $id
        ]);

        $datos = $stmt->fetch();

        // Instancia el objeto Producto con la información recuperada y lo agrega al contenedor del carrito
        $producto = new Producto($datos);
        $carrito->añadirCarrito($producto, 1);

            // Sincroniza el estado modificado en la sesión y define el mensaje de éxito
            $_SESSION['carrito'] = $carrito;
            $_SESSION['mensaje'] = "Producto añadido al carrito.";

            header("Location: producto_controlador.php");
            exit();
    }       
            
    /**
     * Caso de uso: Quitar un producto específico del carrito
     */
    if($accion === "eliminar"){
        // Sanea el identificador del producto a remover
        $id = Helpers::sanear($_POST['producto_id']);

        // Ejecuta la baja del artículo dentro del objeto del carrito
        $carrito->eliminarProducto($id);

        // Sincroniza los cambios en la sesión global y define el mensaje informativo
        $_SESSION['carrito'] = $carrito;
        $_SESSION['mensaje'] = "Producto eliminado del carrito";

        header("Location: producto_controlador.php");
        exit();
    }

    /**
     * Caso de uso: Redirección hacia la pasarela de pago para finalizar el pedido
     */
    if($accion == "checkout"){
        // Valida que el carrito contenga al menos un artículo antes de procesar la compra
        if (empty($_SESSION['carrito']->getCarrito())) {
            $_SESSION['errores'][] = "El carrito está vacío";
            header("Location: producto_controlador.php");
            exit();
        }
        
        // Redirige al script integrador de la pasarela de Stripe
        header("Location: stripe_checkout.php");
        exit();
    }

}

}catch(Exception $e){
    /**
     * Captura errores inesperados, registra el mensaje y redirige para evitar bloqueos
     */
    $_SESSION['errores'][] = $e->getMessage();
    header("Location: producto_controlador.php");
    exit();
}

/**
 * Carga por defecto la vista de la tienda (catálogo de productos)
 */
include "../pages/producto.php";

?>