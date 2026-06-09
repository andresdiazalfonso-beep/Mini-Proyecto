<?php
/**
 * Inicialización del manejo de sesiones en el servidor
 */
session_start();

/**
 * Inclusión de los archivos necesarios para la conexión a la base de datos y el modelo de autenticación
 */
require_once "../conexion/Conexion.php";
require_once "../modelo/LoginModelo.php";

/**
 * Almacena los mensajes de error detectados durante el proceso de autenticación
 */
$errores = [];

/**
 * Procesamiento del formulario de inicio de sesión enviado mediante el método POST
 */
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    /**
     * Establece la conexión con la base de datos e instancia el modelo de login
     */
    $pdo = Conexion::conectar();
    $modelo = new LoginModelo($pdo);

    /**
     * Recopilación y saneamiento de las credenciales introducidas por el usuario
     */
    $email    = $modelo->sanear($_POST['email']);
    $password = $modelo->sanear($_POST['password']);

    /**
     * Búsqueda de los datos del usuario en el sistema a partir del correo introducido
     */
    $usuario = $modelo->obtener_datos($email);

    if ($usuario) {
        /**
         * Verificación de la contraseña introducida contra el hash almacenado de forma segura
         */
        if (password_verify($password, $usuario['password'])) {
            // Guarda la información del usuario autenticado en la sesión global
            $_SESSION['usuario'] = $usuario;

            /**
             * Gestión de persistencia ("Recordar credenciales") mediante el uso de cookies
             */
            if (isset($_POST['recordar'])) {
                // Guarda el email del usuario por un periodo de 30 días
                setcookie('recordar_email', $email,    time() + (30 * 24 * 60 * 60), "/");
            } else {
                // Si la casilla no está marcada, destruye y limpia las cookies existentes del navegador
                setcookie("recordar_email","", time() - 3600, "/");
                setcookie("recordar_password", "", time() - 3600, "/");
            }

            /**
             * Redirección según el nivel de privilegios o rol asignado al usuario
             */
            if($_SESSION['usuario']['rol'] == 'admin'){
                header("Location: /admin/controlador/admin_estadisticascontrolador.php");
                exit();
            }else{
                header("Location: /pages/usuario.php");
                exit();
            }
        } else {
            // Error en caso de que la contraseña no coincida con el registro
            $errores['password'] = "Contraseña Incorrecta";
        }
    } else {
        // Error en caso de que el correo electrónico no exista en la base de datos
        $errores['email'] = "Correo electrónico no registrado";
    }

    /**
     * Persiste el registro de errores en la sesión para que puedan mostrarse en la vista del formulario
     */
    $_SESSION['errores'] = $errores;
}

/**
 * Redirección por defecto de vuelta a la interfaz de login tras procesar los datos o tras accesos directos (GET)
 */
header("Location: ../pages/login.php");
exit();
?>