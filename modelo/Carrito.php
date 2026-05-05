<?php

class Carrito{
    private $carrito = [];

    public function añadirCarrito(Producto $p, $cantidad){
        $id = $p->getId();
        if(isset($this->carrito[$id])){
            $this->carrito[$id]['cantidad'] += $cantidad; 
        }else{
            $this->carrito[$id] = [
                "producto" => $p,
                "cantidad" => $cantidad
            ];
        }
    }

    public function getCarrito(){
        return $this->carrito;
    }

    public function calcularTotal(){
        $total = 0;
        foreach($this->carrito as $item){
            $total += $item['producto']->calcularPrecioFinal($item['cantidad']);
        }
        return $total;
    }

    public function vaciarCarrito(){
        $this->carrito = [];
    }

    public function eliminarProducto($id){
        if(isset($this->carrito[$id])){
            unset($this->carrito[$id]);
        }
    }

    public function checkout($pdo,$id_usuario){
        try {
            $stmt = $pdo->prepare("INSERT INTO pedidos (id_usuario, total) VALUES (:u, :t)");
            $stmt->execute([
                ':u' => $id_usuario,
                ':t' => $this->calcularTotal()
            ]);
            
            $pedido_id = $pdo->lastInsertId();
    
            foreach($this->carrito as $item){
                $stmt = $pdo->prepare("INSERT INTO detalle_pedido (id_pedido, id_producto, cantidad, precio_unitario) 
                VALUES (:pedido_id, :producto_id, :cantidad, :precio)");
                
                $stmt->execute([
                    ':pedido_id' => $pedido_id, 
                    ':producto_id' => $item['producto']->getId(), 
                    ':cantidad' => $item['cantidad'],
                    ':precio' => $item['producto']->calcularPrecioFinal($item['cantidad'])
                ]);
            }
        
            $this->vaciarCarrito();

            return true;
            } catch (PDOException $e) {
                return false;
            }
    }

}

?>