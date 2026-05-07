<?php
/**
 * renovar_suscripciones.php
 * Script CRON: se ejecuta automáticamente una vez al día.
 * Renueva las suscripciones cuya fecha de renovación ha llegado,
 * registra la donación y adelanta la fecha al mes siguiente.
 */

// Rutas relativas al directorio /suscrip/
require_once __DIR__ . '/../Conexion/conexion.php';
require_once __DIR__ . '/../modelo/SuscripcionModelo.php';
require_once __DIR__ . '/../modelo/DineroModelo.php';

$pdo         = Conexion::conectar();
$modeloSusc  = new SuscripcionModelo($pdo);
$modeloDinero = new DineroModelo($pdo);

$pendientes = $modeloSusc->obtenerPendientesRenovacion();

foreach ($pendientes as $suscripcion) {

    // 1. Registrar la donación mensual
    $modeloDinero->guardarDonacion(
        (int)   $suscripcion['id_usuario'],
        (float) $suscripcion['cantidad']
    );

    // 2. Avanzar la fecha de próxima renovación un mes
    $modeloSusc->renovar((int) $suscripcion['id_suscripcion']);

    echo "[OK] Renovada suscripción #{$suscripcion['id_suscripcion']} "
       . "— usuario {$suscripcion['id_usuario']} "
       . "— {$suscripcion['cantidad']}€\n";
}

echo "Total renovadas: " . count($pendientes) . "\n";
