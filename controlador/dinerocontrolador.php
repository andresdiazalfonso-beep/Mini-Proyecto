<?php
session_start();
require_once "../Conexion/conexion.php";
require_once "../modelo/dineromodelo.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    // La cantidad libre tiene prioridad sobre el radio
    if (!empty($_POST['cantidad_libre'])) {
        $cantidad = floatval($_POST['cantidad_libre']);
    } elseif (!empty($_POST['cantidad'])) {
        $cantidad = floatval($_POST['cantidad']);
    } else {
        $_SESSION['error_dinero'] = "Debes seleccionar o introducir una cantidad.";
        header("Location: ../pages/dinero.php");
        exit();
    }

    if ($cantidad < 1) {
        $_SESSION['error_dinero'] = "La cantidad mínima para donar es 1€.";
        header("Location: ../pages/dinero.php");
        exit();
    }

    $id_usuario = $_SESSION['id_usuario'] ?? null;

    // Instanciamos la clase del modelo pasándole la conexión PDO
    $conexion = Conexion::conectar();
    $modelo = new DineroModelo($conexion);
    
    // Llamamos al método
    $resultado = $modelo->guardarDonacion($id_usuario, $cantidad);

    if ($resultado) {
        $_SESSION['donacion_cantidad'] = $cantidad;
        header("Location: ../pages/confirmar_dinero.php");
        exit();
    } else {
        $_SESSION['error_dinero'] = "Ha ocurrido un error al procesar tu donación. Inténtalo de nuevo.";
        header("Location: ../pages/dinero.php");
        exit();
    }
}

header("Location: ../pages/dinero.php");
exit();
?>