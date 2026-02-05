<?php
// Guardar idioma desde el select
if (isset($_POST['idioma'])) {
    setcookie('idioma', $_POST['idioma'], time() + 3600 * 24 * 30);
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
}

// Idioma por defecto
$idioma = $_COOKIE['idioma'] ?? 'es';

// Cargar idioma
$textos = require "$idioma.php";
?>