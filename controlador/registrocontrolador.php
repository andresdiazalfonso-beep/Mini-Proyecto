<?php
session_start();

require_once "../Conexion/conexion.php";
require_once "../modelo/registromodelo.php";

$errores = [];

    $verificar_tabla = "SHOW TABLE LIKE 'usuarios'";
    $resultado = mysqli_query($conexion,$verificar_tabla);

    if(mysqli_num_rows($resultado) == 0){
        $crear_tabla_usuarios = "CREATE TABLE usuarios (
            id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL,
            password VARCHAR(255) NOT NULL
        )";
        mysqli_query($conexion,$crear_tabla_usuarios);
    }

if($_SERVER['REQUEST_METHOD'] === "POST"){

    $datos = [
        "nombre" => sanear($_POST['nombre']),
        "email" => sanear($_POST['email']),
        "password" => sanear($_POST['password']),
        "password_confirm" => sanear($_POST['password_confirm'])
    ];

    $errores = validar_datos($datos,$conexion);
    $_SESSION['errores'] = $errores;

    if(empty($errores)){
        $resultado = guardar_registro($conexion,$datos);

        if($resultado){
            $_SESSION['mensaje'] = "Registro Correcto";
            header("Location: ../pages/registro.php");
            exit();
        }else{
            $_SESSION['errores'][] = "Error al registrar al usuario";
            header("Location: ../pages/registro.php");
            exit();
        }
    }
}
header("Location: ../pages/registro.php");
exit();

?>