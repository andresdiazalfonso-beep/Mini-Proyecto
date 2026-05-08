<?php

class Producto{
    private $id;
    private $nombre;
    private $precio_unitario;

    private $iva = 0.21;

    public function __construct($datos)
    {
        $this->id = $datos['id_producto'];
        $this->nombre = $datos['nombre'];
        $this->precio_unitario = $datos['precio'];
    }

    // Precio SIN IVA
    public function getPrecio(){
        return $this->precio_unitario;
    }

    // IVA solo del producto
    public function getPrecioConIVA(){
        return $this->precio_unitario * (1 + $this->iva);
    }

    // Total con cantidad
    public function calcularPrecioFinal($cantidad){
        return $this->getPrecioConIVA() * $cantidad;
    }

    public function getId(){
        return $this->id;
    }

    public function getNombre(){
        return $this->nombre;
    }
}