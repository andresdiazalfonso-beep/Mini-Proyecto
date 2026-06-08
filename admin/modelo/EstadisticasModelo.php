<?php

class EstadisticasModelo{

    /**
     * Conexión a la base de datos
     */
    private PDO $pdo;

    /**
     * Inicializa el modelo con la instancia de conexión PDO
     */
    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    /**
     * Cuenta la cantidad total de usuarios registrados en la plataforma
     */
    public function totalUsuarios(){
        $stmt = $this->pdo->query("
            SELECT COUNT(*) 
            FROM usuarios
        ");

        return $stmt->fetchColumn();
    }

    /**
     * Cuenta el número total de pedidos generados en el sistema, sin importar su estado
     */
    public function totalPedidos(){
        $stmt = $this->pdo->query("
            SELECT COUNT(*)
            FROM pedidos
        ");

        return $stmt->fetchColumn();
    }

    /**
     * Obtiene el número total de pedidos cuyo pago se ha completado con éxito
     */
    public function pedidosPagados(){
        $stmt = $this->pdo->query("
            SELECT COUNT(*)
            FROM pedidos
            WHERE estado='pagado'
        ");

        return $stmt->fetchColumn();
    }

    /**
     * Calcula la suma total de ingresos económicos obtenidos a través de la venta de productos pagados
     */
    public function ingresosProductos(){
        $stmt = $this->pdo->query("
            SELECT SUM(total)
            FROM pedidos
            WHERE estado='pagado'
        ");

        return $stmt->fetchColumn() ?? 0;
    }

    /**
     * Calcula la suma total de ingresos económicos recolectados mediante donaciones monetarias confirmadas
     */
    public function ingresosDonaciones(){
        $stmt = $this->pdo->query("
            SELECT SUM(cantidad)
            FROM donaciones_dinero
            WHERE estado='pagado'
        ");

        return $stmt->fetchColumn() ?? 0;
    }

    /**
     * Cuenta la cantidad total de transacciones por donación que han sido pagadas
     */
    public function totalDonaciones(){
        $stmt = $this->pdo->query("
            SELECT COUNT(*)
            FROM donaciones_dinero
            WHERE estado='pagado'
        ");

        return $stmt->fetchColumn();
    }

    /**
     * Obtiene el top 5 de los productos más vendidos en base a la cantidad acumulada en los detalles de compra
     */
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

    /**
     * Agrupa e identifica la facturación total de los pedidos pagados desglosada por cada mes del año
     */
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

    /**
     * Agrupa e identifica la recaudación total de las donaciones confirmadas desglosada por cada mes del año
     */
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

    /**
     * Obtiene la distribución y el conteo de todos los pedidos agrupados según su estado actual (pendiente, pagado, etc.)
     */
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