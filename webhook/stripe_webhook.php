<?php
require_once "../config/stripe.php";
require_once "../Conexion/conexion.php";

$endpoint_secret = "whsec_TU_SECRETO";

$payload = file_get_contents("php://input");
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];

try {
    $event = \Stripe\Webhook::constructEvent(
        $payload,
        $sig_header,
        $endpoint_secret
    );
} catch(Exception $e) {
    http_response_code(400);
    exit();
}

if ($event->type === 'checkout.session.completed') {

    $session = $event->data->object;
    $pedido_id = $session->metadata->pedido_id;

    $pdo = Conexion::conectar();

    // Actualizar solo si no está ya pagado (evita duplicados)
    $stmt = $pdo->prepare("
        UPDATE pedidos 
        SET estado = 'pagado'
        WHERE id_pedido = :id
        AND estado != 'pagado'
    ");

    $stmt->execute([':id' => $pedido_id]);
}

http_response_code(200);
?>