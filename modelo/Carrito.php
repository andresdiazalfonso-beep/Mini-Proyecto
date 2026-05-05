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

    public function checkout($pdo,$id_cliente){
        try {
            $stmt = $pdo->prepare("INSERT INTO pedidos (id_usuario, total) VALUES (:u, :t)");
            $stmt->execute([
                ':c' => $id_cliente,
                ':t' => $this->calcularTotal()
            ]);
            
            $pedido_id = $pdo->lastInsertId();
    
            foreach($this->carrito as $item){
                $stmt = $pdo->prepare("INSERT INTO pedido_detalles (pedido_id, producto_id, cantidad, subtotal) 
                VALUES (:pedido_id, :producto_id, :cantidad, :subtotal)");
                
                $stmt->execute([
                    ':pedido_id' => $pedido_id, 
                    ':producto_id' => $item['producto']->getId(), 
                    ':cantidad' => $item['cantidad'],
                    ':subtotal' => $item['producto']->calcularPrecioFinal($item['cantidad'])
                ]);
            }
        
            $this->vaciarCarrito();

            return true;
            } catch (Exception $e) {
                return false;
            }
    }

}

?>