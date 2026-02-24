<?php
require_once "../Conexion/conexion.php";

function buscar_email($email){
    $sql = "SELECT 1 FROM usuarios WHERE email = ? LIMIT 1";
    $stmt = mysqli_prepare($conexion,$sql);

    if($stmt){
        mysqli_stmt_bind_param($stmt,"s",$email);
        mysqli_stmt_execute($stmt);
        
    }

}
?>