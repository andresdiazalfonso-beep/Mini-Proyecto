<?php

class DineroModelo {
    private $conexion;

    // El constructor recibe la conexión PDO
    public function __construct(PDO $conexion) {
        $this->conexion = $conexion;
    }

    public function guardarDonacion($id_usuario, $cantidad) {
        try {
            $sql = "INSERT INTO donaciones_dinero (id_usuario, cantidad) VALUES (?, ?)";
            $stmt = $this->conexion->prepare($sql);
            
            // PDO permite ejecutar directamente pasando un array con los valores
            return $stmt->execute([$id_usuario, $cantidad]);
            
        } catch (PDOException $e) {
            // Opcional: registrar el error
            // ("Error al guardar donación: " . $e->getMessage());
            return false;
        }
    }
}
?>