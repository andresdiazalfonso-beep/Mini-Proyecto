<?php
session_start();

require_once "../modelo/donacionesmodelo.php";
require_once "../../Conexion/conexion.php";

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {

    header("Location: /pages/login.php");
    exit();
}

$pdo = Conexion::conectar();

$modelo = new DonacionesModelo($pdo);


/*
|--------------------------------------------------------------------------
| ELIMINAR DONACIÓN
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $accion = $_POST['accion'] ?? '';

    if ($accion === "eliminar") {

        $id_donacion = intval($_POST['id_donacion']);

        $modelo->eliminarDonacion($id_donacion);

        $_SESSION['mensaje'] = "Donación eliminada correctamente";

        header("Location: ../controlador/admin_donacionescontrolador.php");
        exit();
    }
}


/*
|--------------------------------------------------------------------------
| PAGINACIÓN
|--------------------------------------------------------------------------
*/

$porPagina = 10;

$paginaActual = isset($_GET['pagina'])
    ? max(1, intval($_GET['pagina']))
    : 1;

$totalRegistros = $modelo->contarDonaciones();

$totalPaginas = ceil($totalRegistros / $porPagina);

$offset = ($paginaActual - 1) * $porPagina;


/*
|--------------------------------------------------------------------------
| OBTENER DONACIONES
|--------------------------------------------------------------------------
*/

$donaciones = $modelo->obtenerDonacionesPaginadas(
    $porPagina,
    $offset
);


/*
|--------------------------------------------------------------------------
| ESTADÍSTICAS
|--------------------------------------------------------------------------
*/

$totalDonaciones = $totalRegistros;

$totalIngresos = array_sum(
    array_column($donaciones, 'cantidad')
);

$mensaje = $_SESSION['mensaje'] ?? "";

unset($_SESSION['mensaje']);


/*
|--------------------------------------------------------------------------
| CARGAR VISTA
|--------------------------------------------------------------------------
*/

require_once "../vista/admindonaciones.php";