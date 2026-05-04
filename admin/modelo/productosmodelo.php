<?php
class ProductoModelo {

    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function obtenerProductos() {
        $sql = "SELECT * FROM productos ORDER BY fecha_creacion DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function obtenerProductoPorId(int $id) {
        $sql = "SELECT * FROM productos WHERE id_producto = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $producto = $stmt->fetch();
        return $producto ?: null;
    }

    public function agregarProducto(string $nombre, string $descripcion, float $precio, string $imagen) {
        $sql = "INSERT INTO productos (nombre, descripcion, precio, imagen) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nombre, $descripcion, $precio, $imagen]);
    }

    public function actualizarProducto(int $id, string $nombre, string $descripcion, float $precio, string $imagen) {
        $sql = "UPDATE productos SET nombre=?, descripcion=?, precio=?, imagen=? WHERE id_producto=?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nombre, $descripcion, $precio, $imagen, $id]);
    }

    public function eliminarProducto(int $id) {
        $sql = "DELETE FROM productos WHERE id_producto=?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>