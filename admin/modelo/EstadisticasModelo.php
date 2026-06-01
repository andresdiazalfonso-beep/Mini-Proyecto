<?php

class EstadisticasModelo{

    private PDO $pdo;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    public function totalUsuarios(){
        $stmt = $this->pdo->query("
            SELECT COUNT(*) 
            FROM usuarios
        ");

        return $stmt->fetchColumn();
    }

    public function totalPedidos(){
        $stmt = $this->pdo->query("
            SELECT COUNT(*)
            FROM pedidos
        ");

        return $stmt->fetchColumn();
    }

    public function pedidosPagados(){
        $stmt = $this->pdo->query("
            SELECT COUNT(*)
            FROM pedidos
            WHERE estado='pagado'
        ");

        return $stmt->fetchColumn();
    }

    public function ingresosProductos(){
        $stmt = $this->pdo->query("
            SELECT SUM(total)
            FROM pedidos
            WHERE estado='pagado'
        ");

        return $stmt->fetchColumn() ?? 0;
    }

    public function ingresosDonaciones(){
        $stmt = $this->pdo->query("
            SELECT SUM(cantidad)
            FROM donaciones_dinero
            WHERE estado='pagado'
        ");

        return $stmt->fetchColumn() ?? 0;
    }

    public function totalDonaciones(){
        $stmt = $this->pdo->query("
            SELECT COUNT(*)
            FROM donaciones_dinero
            WHERE estado='pagado'
        ");

        return $stmt->fetchColumn();
    }

    public function productosMasVendidos(){

        $stmt = $this->pdo->query("
            SELECT
                p.nombre,
                SUM(dp.cantidad) vendidos
            FROM detalle_pedido dp
            INNER JOIN productos p
                ON p.id_producto = dp.id_producto
            GROUP BY p.id_producto
            ORDER BY vendidos DESC
            LIMIT 5
        ");

        return $stmt->fetchAll();
    }

    public function ventasMensuales(){

        $stmt = $this->pdo->query("
            SELECT
                MONTH(fecha_pedido) mes,
                SUM(total) total
            FROM pedidos
            WHERE estado='pagado'
            GROUP BY MONTH(fecha_pedido)
            ORDER BY mes
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function donacionesMensuales(){

        $stmt = $this->pdo->query("
            SELECT
                MONTH(fecha) mes,
                SUM(cantidad) total
            FROM donaciones_dinero
            WHERE estado='pagado'
            GROUP BY MONTH(fecha)
            ORDER BY mes
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function estadosPedidos(){

        $stmt = $this->pdo->query("
            SELECT
                estado,
                COUNT(*) total
            FROM pedidos
            GROUP BY estado
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>