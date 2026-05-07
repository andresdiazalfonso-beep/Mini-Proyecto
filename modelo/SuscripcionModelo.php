<?php

/**
 * SuscripcionModelo
 * Gestiona el CRUD de suscripciones mensuales en la base de datos.
 */
class SuscripcionModelo {

    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Crea una nueva suscripción activa para el usuario.
     */
    public function crear(int $id_usuario, float $cantidad): bool {
        $hoy = date('Y-m-d');
        $proxima = date('Y-m-d', strtotime('+1 month'));

        $sql = "INSERT INTO suscripciones_mensuales
                    (id_usuario, cantidad, fecha_inicio, proxima_renovacion, activa)
                VALUES (?, ?, ?, ?, 1)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id_usuario, $cantidad, $hoy, $proxima]);
    }

    /**
     * Devuelve la suscripción activa de un usuario o null si no tiene.
     */
    public function obtenerActiva(int $id_usuario): ?array {
        $sql = "SELECT * FROM suscripciones_mensuales
                WHERE id_usuario = ? AND activa = 1
                LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_usuario]);
        $fila = $stmt->fetch();
        return $fila ?: null;
    }

    /**
     * Cancela la suscripción activa del usuario (pone activa = 0).
     */
    public function cancelar(int $id_usuario): bool {
        $sql = "UPDATE suscripciones_mensuales
                SET activa = 0, fecha_cancelacion = NOW()
                WHERE id_usuario = ? AND activa = 1";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id_usuario]);
    }

    /**
     * Devuelve todas las suscripciones cuya próxima renovación <= hoy y siguen activas.
     * Usado por el script CRON para renovar.
     */
    public function obtenerPendientesRenovacion(): array {
        $hoy = date('Y-m-d');
        $sql = "SELECT * FROM suscripciones_mensuales
                WHERE activa = 1 AND proxima_renovacion <= ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$hoy]);
        return $stmt->fetchAll();
    }

    /**
     * Avanza la fecha de próxima renovación un mes más.
     */
    public function renovar(int $id_suscripcion): bool {
        $sql = "UPDATE suscripciones_mensuales
                SET proxima_renovacion = DATE_ADD(proxima_renovacion, INTERVAL 1 MONTH)
                WHERE id_suscripcion = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id_suscripcion]);
    }
}
