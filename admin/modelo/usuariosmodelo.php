<?php

class UsuariosModelo {

    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function obtenerUsuarios(): array {
        $sql = "SELECT id_usuario, nombre, email, rol, fecha_registro FROM usuarios ORDER BY fecha_registro DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function obtenerUsuarioPorId(int $id): ?array {
        $sql = "SELECT id_usuario, nombre, email, rol, fecha_registro FROM usuarios WHERE id_usuario = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $usuario = $stmt->fetch();
        return $usuario ?: null;
    }

    public function actualizarUsuario(int $id, string $nombre, string $email, string $rol): bool {
        $sql = "UPDATE usuarios SET nombre = ?, email = ?, rol = ? WHERE id_usuario = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nombre, $email, $rol, $id]);
    }

    public function eliminarUsuario(int $id): bool {
        $sql = "DELETE FROM usuarios WHERE id_usuario = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function emailExiste(string $email, int $excluirId = 0): bool {
        $sql = "SELECT 1 FROM usuarios WHERE email = ? AND id_usuario != ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email, $excluirId]);
        return (bool) $stmt->fetchColumn();
    }

    public function totalUsuarios(): int {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM usuarios");
        return (int) $stmt->fetchColumn();
    }
}
?>
