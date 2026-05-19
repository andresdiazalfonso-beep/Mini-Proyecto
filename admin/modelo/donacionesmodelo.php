<?php

class DonacionesModelo {

    private PDO $pdo;

    public function __construct(PDO $pdo) {

        $this->pdo = $pdo;
    }


    /*
    |--------------------------------------------------------------------------
    | OBTENER DONACIONES PAGINADAS
    |--------------------------------------------------------------------------
    */

    public function obtenerDonacionesPaginadas($limite, $offset): array {

        $sql = "
            SELECT 
                d.id_donacion,
                d.cantidad,
                d.estado,
                d.fecha,
                u.nombre,
                u.email
            FROM donaciones_dinero d
            INNER JOIN usuarios u 
                ON d.id_usuario = u.id_usuario
            ORDER BY d.fecha DESC
            LIMIT ? OFFSET ?
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(1, $limite, PDO::PARAM_INT);
        $stmt->bindValue(2, $offset, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll();
    }


    /*
    |--------------------------------------------------------------------------
    | CONTAR DONACIONES
    |--------------------------------------------------------------------------
    */

    public function contarDonaciones(): int {

        $sql = "SELECT COUNT(*) FROM donaciones_dinero";

        $stmt = $this->pdo->query($sql);

        return (int) $stmt->fetchColumn();
    }


    /*
    |--------------------------------------------------------------------------
    | ELIMINAR DONACIÓN
    |--------------------------------------------------------------------------
    */

    public function eliminarDonacion($id): bool {

        $sql = "DELETE FROM donaciones_dinero WHERE id_donacion = ?";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([$id]);
    }
}