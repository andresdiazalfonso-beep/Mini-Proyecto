<?php

class ContactoModelo {

    /**
     * Conexión a la base de datos
     */
    private PDO $pdo;

    /**
     * Inicializa el modelo con la instancia de conexión PDO
     */
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Limpia y sanea una cadena de texto eliminando espacios y convirtiendo caracteres especiales
     */
    public function sanear(string $dato): string {
        return htmlspecialchars(trim($dato));
    }

    /**
     * Valida la longitud y formato de los datos recibidos del formulario de contacto
     */
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

    /**
     * Inserta los datos del mensaje de contacto en la base de datos
     */
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