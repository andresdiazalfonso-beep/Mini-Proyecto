<?php
require_once "../../Conexion/conexion.php";

function obtenerProductos($conexion){
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

function agregarProducto($conexion, $nombre, $descripcion, $precio, $imagen, $stock){
    $sql = "INSERT INTO productos(nombre,descripcion,precio,imagen,stock) VALUES (?,?,?,?,?)";
    $stmt = mysqli_prepare($conexion,$sql);
    mysqli_stmt_bind_param($stmt,"ssdsi",$nombre,$descripcion,$precio,$imagen,$stock);
    return mysqli_stmt_execute($stmt);
}

function actualizarProducto($conexion, $id, $nombre, $descripcion, $precio, $imagen, $stock){
    $sql = "UPDATE productos SET nombre=?, descripcion=?, precio=?, imagen=?, stock=? WHERE id_producto=?";
    $stmt = mysqli_prepare($conexion,$sql);
    mysqli_stmt_bind_param($stmt,"ssdsii",$nombre,$descripcion,$precio,$imagen,$stock,$id);
    return mysqli_stmt_execute($stmt);
}

function eliminarProducto($conexion, $id){
    $sql = "DELETE FROM productos WHERE id_producto=?";
    $stmt = mysqli_prepare($conexion,$sql);
    mysqli_stmt_bind_param($stmt,"i",$id);
    return mysqli_stmt_execute($stmt);
}
?>