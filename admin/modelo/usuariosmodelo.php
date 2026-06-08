<?php

class UsuariosModelo {

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
     * Obtiene el listado completo de usuarios ordenados por fecha de registro de forma descendente
     */
    public function obtenerUsuarios(): array {
        $sql = "SELECT id_usuario, nombre, email, rol, fecha_registro FROM usuarios ORDER BY fecha_registro DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Obtiene los datos de un usuario específico mediante su ID
     */
    public function obtenerUsuarioPorId(int $id): ?array {
        $sql = "SELECT id_usuario, nombre, email, rol, fecha_registro FROM usuarios WHERE id_usuario = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $usuario = $stmt->fetch();
        return $usuario ?: null;
    }

    /**
     * Modifica el nombre, email y rol de un usuario existente en la base de datos
     */
    public function actualizarUsuario(int $id, string $nombre, string $email, string $rol): bool {
        $sql = "UPDATE usuarios SET nombre = ?, email = ?, rol = ? WHERE id_usuario = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nombre, $email, $rol, $id]);
    }

    /**
     * Elimina un usuario del sistema mediante su ID
     */
    public function eliminarUsuario(int $id): bool {
        $sql = "DELETE FROM usuarios WHERE id_usuario = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    /**
     * Comprueba si un email ya está registrado, permitiendo excluir un ID específico durante la edición
     */
    public function emailExiste(string $email, int $excluirId = 0): bool {
        $sql = "SELECT 1 FROM usuarios WHERE email = ? AND id_usuario != ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email, $excluirId]);
        return (bool) $stmt->fetchColumn();
    }

    /**
     * Devuelve la cantidad total de usuarios registrados en el sistema
     */
    public function totalUsuarios(): int {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM usuarios");
        return (int) $stmt->fetchColumn();
    }
}
?>