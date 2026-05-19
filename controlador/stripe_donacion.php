<?php
session_start();

require_once "../config/stripe.php";
require_once "../Conexion/conexion.php";

if (!isset($_SESSION['usuario'])) {

    $_SESSION['error_login'] = "Debes iniciar sesión";

    header("Location: /pages/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    header("Location: /pages/dinero.php");
    exit();
}


// ==========================
// CANTIDAD
// ==========================

if (!empty($_POST['cantidad_libre'])) {

    $cantidad = floatval($_POST['cantidad_libre']);

} elseif (!empty($_POST['cantidad'])) {

    $cantidad = floatval($_POST['cantidad']);

} else {

    $_SESSION['error_dinero'] = "Debes introducir una cantidad";

    header("Location: /pages/dinero.php");
    exit();
}


if ($cantidad < 1) {

    $_SESSION['error_dinero'] = "La cantidad mínima es 1€";

    header("Location: /pages/dinero.php");
    exit();
}


$pdo = Conexion::conectar();


// ==========================
// GUARDAR DONACIÓN PENDIENTE
// ==========================

$stmt = $pdo->prepare("
    INSERT INTO donaciones_dinero 
    (id_usuario, cantidad, estado)
    VALUES (:u, :c, 'pendiente')
");

$stmt->execute([

    ':u' => $_SESSION['usuario']['id_usuario'],
    ':c' => $cantidad

]);

$donacion_id = $pdo->lastInsertId();


// ==========================
// CREAR SESIÓN STRIPE
// ==========================

$session = \Stripe\Checkout\Session::create([

    'payment_method_types' => ['card'],

    'customer_email' => $_SESSION['usuario']['email'],

    'line_items' => [[

        'price_data' => [

            'currency' => 'eur',

            'unit_amount' => round($cantidad * 100),

            'product_data' => [

                'name' => 'Donación ONG Help4África',

                'description' => 'Gracias por apoyar nuestra causa ❤️'

            ],

        ],

        'quantity' => 1,

    ]],

    'mode' => 'payment',

    'metadata' => [

        'donacion_id' => $donacion_id

    ],

    'success_url' =>
        'http://localhost/Mini-Proyecto/pages/resultado_donacion.php?estado=pagado&donacion_id=' . $donacion_id,

    'cancel_url' =>
        'http://localhost/Mini-Proyecto/pages/resultado_donacion.php?estado=cancelado&donacion_id=' . $donacion_id,

]);


// ==========================
// GUARDAR SESSION ID
// ==========================

$stmt = $pdo->prepare("
    UPDATE donaciones_dinero
    SET stripe_session_id = :s
    WHERE id_donacion = :id
");

$stmt->execute([

    ':s' => $session->id,
    ':id' => $donacion_id

]);


header("Location: " . $session->url);
exit();