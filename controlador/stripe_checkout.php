<?php
require_once "../modelo/Producto.php";
require_once "../modelo/Carrito.php";

session_start();

require_once "../config/stripe.php";
require_once "../Conexion/conexion.php";

$carrito = $_SESSION['carrito']->getCarrito();
$pdo = Conexion::conectar();

// 🧾 Crear pedido (pendiente)
$stmt = $pdo->prepare("
    INSERT INTO pedidos (id_usuario, total, estado)
    VALUES (:u, :t, 'pendiente')
");

$stmt->execute([
    ':u' => $_SESSION['usuario']['id_usuario'],
    ':t' => $_SESSION['carrito']->calcularTotal()
]);

$pedido_id = $pdo->lastInsertId();

// Productos para Stripe
$line_items = [];

foreach($carrito as $item){
    $producto = $item['producto'];

    $line_items[] = [
        'quantity' => $item['cantidad'],
        'price_data' => [
            'currency' => 'eur',
            'unit_amount' => $producto->getPrecio() * 100,
            'product_data' => [
                'name' => $producto->getNombre(),
            ],
        ],
    ];
}

// Crear sesión
$session = \Stripe\Checkout\Session::create([

    'payment_method_types' => ['card'],

    'customer_email' => $_SESSION['usuario']['email'],

    'line_items' => $line_items,

    'mode' => 'payment',

    'metadata' => [
        'pedido_id' => $pedido_id
    ],

    'success_url' => 'http://localhost/Mini-Proyecto/pages/resultado_pago.php?estado=pagado&pedido_id=' . $pedido_id,

    'cancel_url' => 'http://localhost/Mini-Proyecto/pages/resultado_pago.php?estado=cancelado&pedido_id=' . $pedido_id,
]);

header("Location: " . $session->url);
exit();
?>