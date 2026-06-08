<?php
session_start();

/**
 * Inclusión de los archivos necesarios para la conexión a la base de datos y el modelo de contacto
 */
require_once "../conexion/Conexion.php";
require_once "../modelo/ContactoModelo.php";

/**
 * Control de acceso: Restringe la ejecución del script únicamente a peticiones de tipo POST
 */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../pages/contacto.php");
    exit();
}

/**
 * Inicialización de la conexión PDO y del modelo de gestión de contactos
 */
$pdo    = Conexion::conectar();
$modelo = new ContactoModelo($pdo);

/**
 * Recopilación y saneamiento de los datos recibidos desde el formulario de contacto
 */
$datos = [
    'nombre'  => $modelo->sanear($_POST['nombre']  ?? ''),
    'email'   => $modelo->sanear($_POST['email']   ?? ''),
    'asunto'  => $modelo->sanear($_POST['asunto']  ?? ''),
    'mensaje' => $modelo->sanear($_POST['mensaje'] ?? ''),
];

/**
 * Validación de los campos del formulario
 */
$errores = $modelo->validar($datos);

/**
 * Si se detectan errores de validación, se almacenan en la sesión y se redirige de vuelta al formulario
 */
if (!empty($errores)) {
    $_SESSION['contacto_errores'] = $errores;
    $_SESSION['contacto_datos']   = $datos;
    header("Location: ../pages/contacto.php");
    exit();
}

/**
 * Intenta almacenar la información del contacto en la base de datos
 */
$resultado = $modelo->guardar($datos);

/**
 * Define el mensaje de éxito o de error general en la sesión según el resultado del guardado
 */
if ($resultado) {
    $_SESSION['contacto_exito'] = "¡Mensaje enviado correctamente! Te responderemos lo antes posible.";
} else {
    $_SESSION['contacto_errores'] = ['general' => "Error al enviar el mensaje. Inténtalo de nuevo."];
}

/**
 * Redirige siempre a la vista del formulario de contacto tras finalizar el procesamiento
 */
header("Location: ../pages/contacto.php");
exit();
?>