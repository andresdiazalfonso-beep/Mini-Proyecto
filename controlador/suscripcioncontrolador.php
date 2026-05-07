<?php
/**
 * suscripcioncontrolador.php
 * Controla las acciones: suscribirse y cancelar suscripción.
 * Ubicación: /controlador/suscripcioncontrolador.php
 */

session_start();
require_once "../Conexion/conexion.php";
require_once "../modelo/DineroModelo.php";
require_once "../modelo/SuscripcionModelo.php";

// Solo usuarios logueados
if (!isset($_SESSION['usuario'])) {
    header("Location: /pages/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: /pages/dinero.php");
    exit();
}

$accion      = $_POST['accion']   ?? '';
$id_usuario  = (int) $_SESSION['usuario']['id_usuario'];
$pdo         = Conexion::conectar();
$modeloSusc  = new SuscripcionModelo($pdo);

// ── SUSCRIBIRSE ─────────────────────────────────────────────
if ($accion === 'suscribir') {

    // Verificar que no tenga ya una activa
    if ($modeloSusc->obtenerActiva($id_usuario)) {
        $_SESSION['error_dinero'] = "Ya tienes una suscripción mensual activa.";
        header("Location: /pages/dinero.php");
        exit();
    }

    // Validar cantidad
    if (!empty($_POST['cantidad_libre'])) {
        $cantidad = floatval($_POST['cantidad_libre']);
    } elseif (!empty($_POST['cantidad'])) {
        $cantidad = floatval($_POST['cantidad']);
    } else {
        $_SESSION['error_dinero'] = "Selecciona o introduce una cantidad para suscribirte.";
        header("Location: /pages/dinero.php");
        exit();
    }

    if ($cantidad < 1) {
        $_SESSION['error_dinero'] = "La cantidad mínima para suscribirse es 1€ al mes.";
        header("Location: /pages/dinero.php");
        exit();
    }

    // 1. Crear suscripción
    $ok = $modeloSusc->crear($id_usuario, $cantidad);

    // 2. Registrar la primera donación inmediatamente
    if ($ok) {
        $modeloDinero = new DineroModelo($pdo);
        $modeloDinero->guardarDonacion($id_usuario, $cantidad);

        $_SESSION['suscripcion_ok']      = true;
        $_SESSION['suscripcion_cantidad'] = $cantidad;
        header("Location: /pages/confirmar_suscripcion.php");
        exit();
    }

    $_SESSION['error_dinero'] = "No se pudo crear la suscripción. Inténtalo de nuevo.";
    header("Location: /pages/dinero.php");
    exit();
}

// ── CANCELAR ────────────────────────────────────────────────
if ($accion === 'cancelar') {
    $modeloSusc->cancelar($id_usuario);
    $_SESSION['info_dinero'] = "Tu suscripción mensual ha sido cancelada.";
    header("Location: /pages/dinero.php");
    exit();
}

header("Location: /pages/dinero.php");
exit();
