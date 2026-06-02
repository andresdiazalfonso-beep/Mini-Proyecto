<?php

session_start();

require_once "../../conexion/Conexion.php";
require_once "../modelo/EstadisticasModelo.php";

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {

    header("Location: /pages/login.php");
    exit();
}

$pdo = Conexion::conectar();
$modelo = new EstadisticasModelo($pdo);

/* TARJETAS */
$totalUsuarios      = $modelo->totalUsuarios();
$totalPedidos       = $modelo->totalPedidos();
$pedidosPagados     = $modelo->pedidosPagados();

$ingresosProductos  = $modelo->ingresosProductos();
$ingresosDonaciones = $modelo->ingresosDonaciones();

$totalRecaudado = $ingresosProductos + $ingresosDonaciones;

$totalDonaciones = $modelo->totalDonaciones();

/* TABLA */
$productosMasVendidos = $modelo->productosMasVendidos();

/* VENTAS MENSUALES */
$ventasMensuales = $modelo->ventasMensuales();

$meses = [];
$totales = [];

foreach($ventasMensuales as $venta){
    $meses[] = $venta['mes'];
    $totales[] = $venta['total'];
}

/* DONACIONES MENSUALES */
$donacionesMensuales = $modelo->donacionesMensuales();

$mesesDonaciones = [];
$totalesDonaciones = [];

foreach($donacionesMensuales as $donacion){
    $mesesDonaciones[] = $donacion['mes'];
    $totalesDonaciones[] = $donacion['total'];
}

/* ESTADO PEDIDOS */
$estadosPedidos = $modelo->estadosPedidos();

$estados = [];
$totalesEstados = [];

foreach($estadosPedidos as $estado){
    $estados[] = $estado['estado'];
    $totalesEstados[] = $estado['total'];
}

require_once "../vista/admin_estadisticas.php";
?>