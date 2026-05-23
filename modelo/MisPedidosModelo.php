<?php
class MisPedidosModelo {

    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function obtenerTodos(int $idUsuario): array {
        $sql  = "SELECT id_pedido, total, estado, fecha
                 FROM pedidos
                 WHERE id_usuario = ?
                 ORDER BY fecha DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$idUsuario]);
        return $stmt->fetchAll();
    }
}
?>