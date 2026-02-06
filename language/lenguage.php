<?php
// Idiomas permitidos
$idiomasPermitidos = ['es', 'en'];

// Guardar idioma desde el select
if (isset($_POST['idioma']) && in_array($_POST['idioma'], $idiomasPermitidos)) {
    setcookie(
        'idioma',
        $_POST['idioma'],
        time() + (3600 * 24 * 30),
        '/'
    );
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
}

// Idioma por defecto
$idioma = $_COOKIE['idioma'] ?? 'es';

// Validar cookie
if (!in_array($idioma, $idiomasPermitidos)) {
    $idioma = 'es';
}

// Cargar archivo de idioma
$textos = include_once __DIR__ . "/$idioma.php";
?>