<?php
class ContactoModelo {

    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function sanear(string $dato): string {
        return htmlspecialchars(trim($dato));
    }

    public function validar(array $datos): array {
        $errores = [];

        if (strlen($datos['nombre']) < 2) {
            $errores['nombre'] = "El nombre debe tener al menos 2 caracteres.";
        }

        if (!filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) {
            $errores['email'] = "El correo no tiene un formato válido.";
        }

        if (strlen($datos['mensaje']) < 10) {
            $errores['mensaje'] = "El mensaje debe tener al menos 10 caracteres.";
        }

        return $errores;
    }

    public function guardar(array $datos): bool {
        $sql = "INSERT INTO contactos (nombre, email, asunto, mensaje) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $datos['nombre'],
            $datos['email'],
            $datos['asunto'],
            $datos['mensaje']
        ]);
    }
}
?>