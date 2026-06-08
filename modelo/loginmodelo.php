<?php

class LoginModelo {

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
    public function sanear(string $datos) {
        return htmlspecialchars(trim($datos));
    }

    /**
     * Recupera las credenciales y datos de perfil de un usuario mediante su correo electrónico
     */
    public function obtener_datos(string $email) {
        $sql = "SELECT id_usuario, nombre, email, password, rol FROM usuarios WHERE email = ? LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        $usuario = $stmt->fetch();
        return $usuario ?: null;
    }
}
?>