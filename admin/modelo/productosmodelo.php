<?php

class ProductoModelo {

    /**
     * @var PDO Conexión a la base de datos
     */
    private PDO $pdo;

    /**
     * Inicializa el modelo con la instancia de conexión PDO
     */
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Obtiene todos los productos ordenados por fecha de creación de forma descendente
     */
    public function obtenerProductos() {
        $sql = "SELECT * FROM productos ORDER BY fecha_creacion DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Obtiene los datos de un producto específico mediante su ID
     */
    public function obtenerProductoPorId(int $id) {
        $sql = "SELECT * FROM productos WHERE id_producto = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $producto = $stmt->fetch();
        return $producto ?: null;
    }

    /**
     * Registra un nuevo producto en la base de datos
     */
    public function agregarProducto(string $nombre, string $descripcion, float $precio, string $imagen) {
        $sql = "INSERT INTO productos (nombre, descripcion, precio, imagen) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nombre, $descripcion, $precio, $imagen]);
    }

    /**
     * Modifica los datos de un producto existente en la base de datos
     */
    public function actualizarProducto(int $id, string $nombre, string $descripcion, float $precio, string $imagen) {
        $sql = "UPDATE productos SET nombre=?, descripcion=?, precio=?, imagen=? WHERE id_producto=?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nombre, $descripcion, $precio, $imagen, $id]);
    }

    /**
     * Elimina un producto de la base de datos mediante su ID
     */
    public function eliminarProducto(int $id) {
        $sql = "DELETE FROM productos WHERE id_producto=?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>