<?php

class PedidosModelo {

    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function obtenerPedidos(): array {
        $sql = "
            SELECT 
                p.id_pedido,
                p.total,
                p.estado,
                p.fecha,
                u.nombre AS nombre_usuario,
                u.email  AS email_usuario
            FROM pedidos p
            INNER JOIN usuarios u ON p.id_usuario = u.id_usuario
            ORDER BY p.fecha DESC
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function obtenerPedidoPorId(int $id): ?array {
        $sql = "
            SELECT 
                p.id_pedido,
                p.total,
                p.estado,
                p.fecha,
                u.nombre AS nombre_usuario,
                u.email  AS email_usuario
            FROM pedidos p
            INNER JOIN usuarios u ON p.id_usuario = u.id_usuario
            WHERE p.id_pedido = ?
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $pedido = $stmt->fetch();
        return $pedido ?: null;
    }

    public function obtenerDetallePedido(int $id): array {
        $sql = "
            SELECT 
                dp.cantidad,
                dp.precio_unitario,
                pr.nombre
            FROM detalle_pedido dp
            INNER JOIN productos pr ON dp.id_producto = pr.id_producto
            WHERE dp.id_pedido = ?
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    public function actualizarEstado(int $id, string $estado): bool {
        $sql = "UPDATE pedidos SET estado = ? WHERE id_pedido = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$estado, $id]);
    }

    public function eliminarPedido(int $id): bool {
        // Primero eliminar detalles por integridad referencial
        $sqlDetalle = "DELETE FROM detalle_pedido WHERE id_pedido = ?";
        $stmt = $this->pdo->prepare($sqlDetalle);
        $stmt->execute([$id]);

        $sql = "DELETE FROM pedidos WHERE id_pedido = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function totalPedidos(): int {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM pedidos");
        return (int) $stmt->fetchColumn();
    }
}
?>
