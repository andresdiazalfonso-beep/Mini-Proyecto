<?php
require_once "../modelo/Carrito.php";   // 👈 IMPORTANTE
require_once "../Conexion/conexion.php";

session_start();
require_once "../Conexion/conexion.php";

$estado = $_GET['estado'] ?? '';
$pedido_id = $_GET['pedido_id'] ?? '';

$pdo = Conexion::conectar();

if($pedido_id && $estado){

    // 🔥 actualizar estado
    $stmt = $pdo->prepare("
        UPDATE pedidos 
        SET estado = :estado
        WHERE id_pedido = :id
    ");

    $stmt->execute([
        ':estado' => $estado,
        ':id' => $pedido_id
    ]);

    // 🧹 vaciar carrito si pagó
    if($estado == "pagado"){
        $_SESSION['carrito']->vaciarCarrito();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Resultado del pago</title>

<link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="bg-white p-10 rounded-2xl shadow-xl text-center max-w-md">

<?php if($estado == "pagado"): ?>

    <div class="text-6xl mb-4">🎉</div>

    <h1 class="text-3xl font-extrabold text-green-600 mb-3">
        Pago realizado
    </h1>

    <p class="text-gray-500 mb-6">
        Gracias por tu donación ❤️
    </p>

<?php else: ?>

    <div class="text-6xl mb-4">❌</div>

    <h1 class="text-3xl font-extrabold text-red-600 mb-3">
        Pago cancelado
    </h1>

    <p class="text-gray-500 mb-6">
        Tu donación no se ha completado.
    </p>

<?php endif; ?>

<a href="../controlador/producto_controlador.php"
   class="inline-block bg-[#e36935e6] text-white px-6 py-3 rounded-xl font-bold hover:bg-[#cf5f2f] transition">
    Volver
</a>

</div>

</body>
</html>