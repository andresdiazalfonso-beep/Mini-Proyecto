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

}

?>