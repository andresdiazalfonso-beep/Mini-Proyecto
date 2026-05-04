<?php
class LoginModelo {

    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function sanear(string $datos) {
        return htmlspecialchars(trim($datos));
    }

    public function obtener_datos(string $email) {
        $sql = "SELECT id_usuario, nombre, email, password, rol FROM usuarios WHERE email = ? LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        $usuario = $stmt->fetch();
        return $usuario ?: null;
    }
}
?>