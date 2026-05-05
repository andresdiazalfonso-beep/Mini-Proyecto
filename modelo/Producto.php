<?php

class Producto{
    private $id;
    private $nombre;
    private $precio_unitario;

    public function __construct($datos)
    {
        $this->id=$datos['id_producto'];
        $this->nombre=$datos['nombre'];
        $this->precio_unitario=$datos['precio'];
    }

    public function calcularPrecioFinal($cantidad){
        return $this->precio_unitario * $cantidad;
    }

    public function getId(){
        return $this->id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getPrecio(){
        $this->precio_unitario;
    }
}


?>