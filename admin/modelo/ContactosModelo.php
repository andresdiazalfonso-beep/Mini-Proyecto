<?php

class ContactosModelo {

    private PDO $pdo;

    public function __construct(PDO $pdo) {

        $this->pdo = $pdo;
    }


    /*
    |--------------------------------------------------------------------------
    | OBTENER CONTACTOS PAGINADOS
    |--------------------------------------------------------------------------
    */

    public function obtenerContactosPaginados($limite, $offset): array {

        $sql = "
            SELECT
                id_contacto,
                nombre,
                email,
                asunto,
                mensaje,
                fecha
            FROM contactos
            ORDER BY fecha DESC
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
    | CONTAR CONTACTOS
    |--------------------------------------------------------------------------
    */

    public function contarContactos(): int {

        $sql = "SELECT COUNT(*) FROM contactos";

        $stmt = $this->pdo->query($sql);

        return (int) $stmt->fetchColumn();
    }


    /*
    |--------------------------------------------------------------------------
    | ELIMINAR CONTACTO
    |--------------------------------------------------------------------------
    */

    public function eliminarContacto($id): bool {

        $sql = "DELETE FROM contactos WHERE id_contacto = ?";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([$id]);
    }
}