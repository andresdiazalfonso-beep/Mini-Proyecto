<?php

class PerfilModelo {

    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function sanear(string $dato): string {
        return htmlspecialchars(trim($dato));
    }

    /**
     * Obtiene todos los datos del usuario por ID
     */
    public function obtenerPorId(int $id): ?array {
        $sql = "SELECT id_usuario, nombre, email, rol, fecha_registro FROM usuarios WHERE id_usuario = ? LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $usuario = $stmt->fetch();
        return $usuario ?: null;
    }

    /**
     * Comprueba si ya existe otro usuario con ese nombre (excluyendo el propio)
     */
    public function nombreExiste(string $nombre, int $excluirId): bool {
        $sql = "SELECT 1 FROM usuarios WHERE nombre = ? AND id_usuario != ? LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nombre, $excluirId]);
        return (bool) $stmt->fetchColumn();
    }

    /**
     * Comprueba si ya existe otro usuario con ese email (excluyendo el propio)
     */
    public function emailExiste(string $email, int $excluirId): bool {
        $sql = "SELECT 1 FROM usuarios WHERE email = ? AND id_usuario != ? LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email, $excluirId]);
        return (bool) $stmt->fetchColumn();
    }

    /**
     * Valida los datos antes de actualizar el perfil
     */
    public function validar(array $datos, int $idUsuario): array {
        $errores = [];

        if (strlen($datos['nombre']) < 4) {
            $errores['nombre'] = "El nombre debe tener al menos 4 caracteres.";
        }

        if (!filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) {
            $errores['email'] = "El correo no tiene un formato válido.";
        }

        if ($this->nombreExiste($datos['nombre'], $idUsuario)) {
            $errores['nombre'] = "Ese nombre ya está en uso por otro usuario.";
        }

        if ($this->emailExiste($datos['email'], $idUsuario)) {
            $errores['email'] = "Ese correo ya está registrado por otro usuario.";
        }

        return $errores;
    }

    /**
     * Actualiza nombre y email del usuario
     */
    public function actualizar(int $id, string $nombre, string $email): bool {
        $sql = "UPDATE usuarios SET nombre = ?, email = ? WHERE id_usuario = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nombre, $email, $id]);
    }
}
?>