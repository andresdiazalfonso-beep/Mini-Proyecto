<?php

function sanear($datos){
    return htmlspecialchars(trim($datos));
}

function buscar_email($email,$conexion){
    $sql = "SELECT id_usuario, nombre, email, password FROM usuarios WHERE email = ? LIMIT 1";
    $stmt = mysqli_prepare($conexion,$sql);

    if($stmt){
        mysqli_stmt_bind_param($stmt,"s",$email);
        mysqli_stmt_execute($stmt);
        
        $resultado = mysqli_stmt_get_result($stmt);

        if($resultado && mysqli_stmt_num_rows($resultado) > 0){
            $usuario = mysqli_fetch_assoc($resultado);
            mysqli_stmt_close($stmt);
            return $usuario;
        }else{
            mysqli_stmt_close($stmt);
            return null;
        }
    }else{
        return null;
    }

}
?>