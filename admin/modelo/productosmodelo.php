<?php
require_once "../../Conexion/conexion.php";

function obtenerProductos(){

    global $conexion;
    $sql = "SELECT * FROM productos ORDER BY fecha_creacion DESC";
    $resultado = mysqli_query($conexion, $sql);
    return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
}

function obtenerProductoPorId($conexion, $id){

    $sql = "SELECT * FROM productos WHERE id_producto=?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt,"i",$id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($res);
}

function agregarProducto($conexion, $nombre, $descripcion, $precio, $imagen){
    
    $sql = "INSERT INTO productos(nombre, descripcion, precio, imagen) VALUES (?,?,?,?)";
    $stmt = mysqli_prepare($conexion,$sql);
    mysqli_stmt_bind_param($stmt,"ssdb",$nombre,$descripcion,$precio,$imagen);
    mysqli_stmt_send_long_data($stmt,3,$imagen);
    return mysqli_stmt_execute($stmt);
}

function actualizarProducto($conexion, $id, $nombre, $descripcion, $precio, $imagen){

    $sql = "UPDATE productos SET nombre=?, descripcion=?, precio=?, imagen=? WHERE id_producto=?";
    $stmt = mysqli_prepare($conexion,$sql);
    mysqli_stmt_bind_param($stmt,"ssdsi",$nombre,$descripcion,$precio,$imagen,$id);
    return mysqli_stmt_execute($stmt);
}

function eliminarProducto($conexion, $id){
    
    $sql = "DELETE FROM productos WHERE id_producto=?";
    $stmt = mysqli_prepare($conexion,$sql);
    mysqli_stmt_bind_param($stmt,"i",$id);
    return mysqli_stmt_execute($stmt);
}
?>