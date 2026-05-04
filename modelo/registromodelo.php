<?php
class RegistroModelo {

    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function sanear(string $datos) {
        return htmlspecialchars(trim($datos));
    }

    public function validar_datos(array $datos) {
        $errores = [];

        if (strlen($datos['nombre']) < 4) {
            $errores['nombre'] = "El nombre debe tener al menos 4 caracteres";
        }

        if (!filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) {
            $errores['email'] = "El correo no tiene formato";
        }

        if (strlen($datos['password']) < 6) {
            $errores['password'] = "La contraseña debe tener al menos 6 caracteres";
        }

        if ($datos['password'] !== $datos['password_confirm']) {
            $errores['password_confirm'] = "Las contraseñas no coinciden";
        }

        // Validar si existe ya el email
        $sql = "SELECT 1 FROM usuarios WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$datos['email']]);
        if ($stmt->fetchColumn()) {
            $errores['email'] = "El correo ya está registrado";
        }

        return $errores;
    }

    public function guardar_registro(array $datos) {
        $sql = "INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $hash = password_hash($datos['password'], PASSWORD_DEFAULT);
        return $stmt->execute([$datos['nombre'], $datos['email'], $hash]);
    }
}
?>