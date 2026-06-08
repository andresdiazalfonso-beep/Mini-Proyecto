<?php
/**
 * Inicialización del manejo de sesiones en el servidor
 */
session_start();

/**
 * Inclusión de los archivos necesarios para la conexión a la base de datos y el modelo de registro
 */
require_once "../conexion/Conexion.php";
require_once "../modelo/RegistroModelo.php";

/**
 * @var array Almacena los mensajes de error detectados durante la validación del formulario
 */
$errores = [];

/**
 * Procesamiento del formulario de registro enviado mediante el método POST
 */
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    /**
     * Establece la conexión con la base de datos e instancia el modelo de registro
     */
    $pdo    = Conexion::conectar();
    $modelo = new RegistroModelo($pdo);

    /**
     * Recopilación y saneamiento de los datos introducidos por el usuario en el formulario
     */
    $datos = [
        "nombre"           => $modelo->sanear($_POST['nombre']),
        "email"            => $modelo->sanear($_POST['email']),
        "password"         => $modelo->sanear($_POST['password']),
        "password_confirm" => $modelo->sanear($_POST['password_confirm'])
    ];

    /**
     * Ejecución de las reglas de validación sobre los datos del nuevo usuario
     */
    $errores = $modelo->validar_datos($datos);
    $_SESSION['errores'] = $errores;

    /**
     * Si no existen errores de validación, se procede con la creación de la cuenta
     */
    if (empty($errores)) {
        /**
         * Intenta registrar e insertar al nuevo usuario en el sistema
         */
        $resultado = $modelo->guardar_registro($datos);

        /**
         * Redirección condicional según el éxito o fracaso de la inserción
         */
        if ($resultado) {
            // Éxito: Redirige a la pantalla de login para que inicie sesión
            header("Location: ../pages/login.php");
            exit();
        } else {
            // Fallo en la base de datos: Notifica el problema y recarga el formulario
            $_SESSION['errores'][] = "Error al registrar al usuario";
            header("Location: ../pages/registro.php");
            exit();
        }
    }
}

/**
 * Redirección de seguridad por defecto de vuelta a la vista de registro
 */
header("Location: ../pages/registro.php");
exit();
?>