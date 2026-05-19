<?php
require_once "../modelo/Carrito.php";
require_once "../Conexion/conexion.php";

session_start();

$estado = $_GET['estado'] ?? '';

$pedido_id = $_GET['pedido_id'] ?? null;
$donacion_id = $_GET['donacion_id'] ?? null;

$pdo = Conexion::conectar();


// =====================================
// PEDIDOS PRODUCTOS
// =====================================

if($pedido_id && $estado){

    $stmt = $pdo->prepare("
        UPDATE pedidos
        SET estado = :estado
        WHERE id_pedido = :id
    ");

    $stmt->execute([

        ':estado' => $estado,
        ':id' => $pedido_id

    ]);


    // Vaciar carrito si se pagó
    if($estado == "pagado" && isset($_SESSION['carrito'])){

        $_SESSION['carrito']->vaciarCarrito();
    }
}



// =====================================
// DONACIONES
// =====================================

if($donacion_id && $estado){

    $stmt = $pdo->prepare("
        UPDATE donaciones_dinero
        SET estado = :estado
        WHERE id_donacion = :id
    ");

    $stmt->execute([

        ':estado' => $estado,
        ':id' => $donacion_id

    ]);
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

<body class="bg-[#f5f5f5] min-h-screen flex items-center justify-center p-6">

<div class="bg-white p-10 rounded-3xl shadow-2xl text-center max-w-lg w-full border border-gray-100">

<?php if($estado == "pagado"): ?>

    <div class="text-7xl mb-5">
        ❤️
    </div>

    <h1 class="text-4xl font-black text-[#e36935e6] mb-4">
        ¡Pago realizado!
    </h1>

    <p class="text-gray-600 mb-8 text-lg leading-relaxed">

        <?php if($pedido_id): ?>

            Gracias por tu compra solidaria.

        <?php elseif($donacion_id): ?>

            Gracias por apoyar nuestra ONG con tu donación ❤️

        <?php endif; ?>

    </p>

<?php else: ?>

    <div class="text-7xl mb-5">
        ❌
    </div>

    <h1 class="text-4xl font-black text-red-500 mb-4">
        Pago cancelado
    </h1>

    <p class="text-gray-600 mb-8 text-lg">
        No se ha realizado ningún cargo.
    </p>

<?php endif; ?>

<a href="../pages/index.php"
   class="inline-block bg-[#e36935e6] text-white px-8 py-4 rounded-2xl font-bold hover:bg-[#cf5f2f] transition-all duration-300 shadow-lg">

    Volver al inicio

</a>

</div>

</body>
</html>