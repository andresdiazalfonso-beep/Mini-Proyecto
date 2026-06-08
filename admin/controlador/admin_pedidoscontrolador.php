<?php
session_start();

require_once "../modelo/PedidosModelo.php";
require_once "../../conexion/Conexion.php";

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {

    header("Location: /pages/login.php");
    exit();
}

$pdo = Conexion::conectar();

$modelo = new PedidosModelo($pdo);

/* =========================
   GESTIÓN DE ACCIONES POST
========================= */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $accionPost = $_POST['accion'] ?? '';
    $idPost     = intval($_POST['id_pedido'] ?? 0);

    if ($accionPost === 'eliminar' && $idPost > 0) {
        $modelo->eliminarPedido($idPost);
        $_SESSION['mensaje'] = "Pedido #$idPost eliminado correctamente.";
    }

    if ($accionPost === 'cambiar_estado' && $idPost > 0) {
        $nuevoEstado = $_POST['estado'] ?? '';
        $estadosValidos = ['pendiente', 'pagado', 'cancelado'];
        if (in_array($nuevoEstado, $estadosValidos)) {
            $modelo->actualizarEstado($idPost, $nuevoEstado);
            $_SESSION['mensaje'] = "Estado del pedido #$idPost actualizado a '$nuevoEstado'.";
        }
    }

    header("Location: /admin/vista/adminpedidos.php");
    exit();
}

$accion = isset($_GET['accion'])
    ? htmlspecialchars(trim($_GET['accion']))
    : "lista";

$id_pedido = isset($_GET['id_pedido'])
    ? intval($_GET['id_pedido'])
    : 0;

$mensaje = $_SESSION['mensaje'] ?? "";
unset($_SESSION['mensaje']);



/* =========================
   PAGINACIÓN
========================= */

$limite = 10;

$pagina = isset($_GET['pagina'])
    ? max(1, intval($_GET['pagina']))
    : 1;

$offset = ($pagina - 1) * $limite;

$totalPedidos = $modelo->contarPedidos();

$totalPaginas = ceil($totalPedidos / $limite);

$pedidos = $modelo->obtenerPedidosPaginados($limite, $offset);



/* =========================
   TARJETAS RESUMEN
========================= */

$totalPendientes = count(array_filter($pedidos, fn($p) => $p['estado'] === 'pendiente'));

$totalPagados = count(array_filter($pedidos, fn($p) => $p['estado'] === 'pagado'));

$totalCancelados = count(array_filter($pedidos, fn($p) => $p['estado'] === 'cancelado'));

$ingresoTotal = array_sum(
    array_column(
        array_filter($pedidos, fn($p) => $p['estado'] === 'pagado'),
        'total'
    )
);

?>