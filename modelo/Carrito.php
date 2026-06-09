<?php

class Carrito{
    /**
     * Almacena los elementos añadidos al carrito estructurados por su ID
     */
    private $carrito = [];

    /**
     * Añade un producto al carrito o incrementa su cantidad si ya existe
     */
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

    /**
     * Devuelve el listado completo de los elementos presentes en el carrito
     */
    public function getCarrito(){
        return $this->carrito;
    }

    /**
     * Calcula el importe total acumulado recorriendo cada artículo del carrito
     */
    public function calcularTotal(){
        $total = 0;
        foreach($this->carrito as $item){
            $total += $item['producto']->calcularPrecioFinal($item['cantidad']);
        }
        return $total;
    }

    /**
     * Elimina los productos almacenados en el carrito (vacía el carrito)
     */
    public function vaciarCarrito(){
        $this->carrito = [];
    }

    /**
     * Elimina un producto específico del carrito utilizando su ID
     */
    public function eliminarProducto($id){
        if(isset($this->carrito[$id])){
            unset($this->carrito[$id]);
        }
    }

}

?>