<?php

function sanear($datos){
    return htmlspecialchars(trim($datos));
}

function buscar_email($email,$conexion){
    $sql = "SELECT 1 FROM usuarios WHERE email = ? LIMIT 1";
    $stmt = mysqli_prepare($conexion,$sql);

    if($stmt){
        mysqli_stmt_bind_param($stmt,"s",$email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        $existe = mysqli_stmt_num_rows($stmt) > 0;

        mysqli_stmt_close($stmt);

        return $existe;
    }

}
?>