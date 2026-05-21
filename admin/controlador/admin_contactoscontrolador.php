<?php
session_start();

require_once "../modelo/ContactosModelo.php";
require_once "../../conexion/Conexion.php";

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {

    header("Location: /pages/login.php");
    exit();
}

$pdo = Conexion::conectar();

$modelo = new ContactosModelo($pdo);


/*
|--------------------------------------------------------------------------
| ELIMINAR CONTACTO
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $accion = $_POST['accion'] ?? '';

    if ($accion === "eliminar") {

        $id_contacto = intval($_POST['id_contacto']);

        $modelo->eliminarContacto($id_contacto);

        $_SESSION['mensaje'] = "Mensaje eliminado correctamente";

        header("Location: ../controlador/admin_contactoscontrolador.php");
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

$totalRegistros = $modelo->contarContactos();

$totalPaginas = ceil($totalRegistros / $porPagina);

$offset = ($paginaActual - 1) * $porPagina;


/*
|--------------------------------------------------------------------------
| OBTENER CONTACTOS
|--------------------------------------------------------------------------
*/

$contactos = $modelo->obtenerContactosPaginados(
    $porPagina,
    $offset
);


/*
|--------------------------------------------------------------------------
| ESTADÍSTICAS
|--------------------------------------------------------------------------
*/

$totalContactos = $totalRegistros;

$mensaje = $_SESSION['mensaje'] ?? "";

unset($_SESSION['mensaje']);


/*
|--------------------------------------------------------------------------
| CARGAR VISTA
|--------------------------------------------------------------------------
*/

require_once "../vista/admincontactos.php";