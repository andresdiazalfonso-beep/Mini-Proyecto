<?php

class DonacionesModelo {

    private PDO $pdo;

    public function __construct(PDO $pdo) {

        $this->pdo = $pdo;
    }


    /*
    |--------------------------------------------------------------------------
    | OBTENER DONACIONES
    |--------------------------------------------------------------------------
    */

    public function obtenerDonaciones(): array {

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
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();
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