<?php
$basedatos = mysqli_connect("localhost","root","",);

$verificar_basedatos = "SHOW DATABASE LIKE 'help4africa'";
$resultado = mysqli_query($basedatos,$verificar_basedatos);

if(mysqli_num_rows($resultado) == 0){
    $crear_basedatos = "CREATE DATABASE help4afica";
    mysqli_query($basedatos,$crear_basedatos);
    $conexion = mysqli_connect("localhost","root","","help4africa");
}






?>