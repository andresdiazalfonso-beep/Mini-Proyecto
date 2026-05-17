<?php
session_start();
require_once "../modelo/pedidosmodelo.php";
require_once "../../Conexion/conexion.php";

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header("Location: /pages/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $pdo    = Conexion::conectar();
    $modelo = new PedidosModelo($pdo);

    $accion    = htmlspecialchars(trim($_POST['accion']));
    $id_pedido = intval($_POST['id_pedido']);

    if ($accion === "cambiar_estado") {
        $estadosValidos = ['pendiente', 'pagado', 'cancelado'];
        $estado = in_array($_POST['estado'], $estadosValidos) ? $_POST['estado'] : 'pendiente';

        $modelo->actualizarEstado($id_pedido, $estado);
        $_SESSION['mensaje'] = "Estado del pedido actualizado correctamente";
        header("Location: admin_pedidoscontrolador.php");
        exit();
    }

    if ($accion === "eliminar") {
        $modelo->eliminarPedido($id_pedido);
        $_SESSION['mensaje'] = "Pedido eliminado correctamente";
        header("Location: admin_pedidoscontrolador.php");
        exit();
    }
}

header("Location: ../vista/adminpedidos.php");
exit();
?>
