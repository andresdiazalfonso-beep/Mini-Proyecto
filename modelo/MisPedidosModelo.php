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

    public function obtenerPaginados($idUsuario, $limit, $offset)
{
    $sql = "SELECT * FROM pedidos
            WHERE id_usuario = ?
            ORDER BY fecha DESC
            LIMIT ? OFFSET ?";

    $stmt = $this->pdo->prepare($sql);

    $stmt->bindValue(1, $idUsuario, PDO::PARAM_INT);
    $stmt->bindValue(2, $limit, PDO::PARAM_INT);
    $stmt->bindValue(3, $offset, PDO::PARAM_INT);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
?>