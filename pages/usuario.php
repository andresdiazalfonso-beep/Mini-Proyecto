<?php
session_start();
require_once "../conexion/Conexion.php";

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$usuario = $_SESSION['usuario'];

$pdo = Conexion::conectar();

/* PEDIDOS DEL USUARIO */
$sqlPedidos = "SELECT COUNT(*) FROM pedidos WHERE id_usuario = ?";
$stmtPedidos = $pdo->prepare($sqlPedidos);
$stmtPedidos->execute([$usuario['id_usuario']]);
$totalPedidos = $stmtPedidos->fetchColumn();

/* TOTAL GASTADO */
$sqlGastado = "SELECT SUM(total) FROM pedidos WHERE id_usuario = ? AND estado = 'pagado'";
$stmtGastado = $pdo->prepare($sqlGastado);
$stmtGastado->execute([$usuario['id_usuario']]);
$totalGastado = $stmtGastado->fetchColumn() ?? 0;

/* DONACIONES */
$sqlDonaciones = "SELECT SUM(cantidad) FROM donaciones_dinero WHERE id_usuario = ? AND estado = 'pagado'";
$stmtDonaciones = $pdo->prepare($sqlDonaciones);
$stmtDonaciones->execute([$usuario['id_usuario']]);
$totalDonado = $stmtDonaciones->fetchColumn() ?? 0;

/* PEDIDOS RECIENTES */
$sqlRecientes = "SELECT * FROM pedidos
                 WHERE id_usuario = ?
                 ORDER BY fecha_pedido DESC
                 LIMIT 5";
$stmtRecientes = $pdo->prepare($sqlRecientes);
$stmtRecientes->execute([$usuario['id_usuario']]);
$pedidosRecientes = $stmtRecientes->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<title>Mi Panel</title>

</head>
<body class="bg-[#f8f4f1] font-[Poppins]">

<!-- NAVBAR -->
<?php include "../partials/header.php"; ?>

<div class="max-w-7xl mx-auto px-6 pt-24 mt-10 pb-15">

    <!-- BIENVENIDA -->
    <div class="bg-gradient-to-r from-[#e36935e6] to-orange-500 rounded-3xl p-8 text-white mb-8 shadow-lg">

        <h2 class="text-4xl font-black mb-2">
            ¡Hola <?= htmlspecialchars($usuario['nombre']) ?>!
        </h2>

        <p class="text-orange-100 text-lg flex items-center gap-2">
            Gracias por apoyar Help4Africa
            <img class="w-6 h-6 object-contain shrink-0"
                src="../../assets/iconos/heart-svgrepo-com.svg"
                alt="corazon">
        </p>

    </div>


    <!-- TARJETAS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        <!-- PEDIDOS -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition duration-300">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm uppercase tracking-wide text-gray-400 font-semibold">
                        Pedidos
                    </p>

                    <h3 class="text-4xl font-black mt-2 text-gray-800">
                        <?= $totalPedidos ?>
                    </h3>
                </div>

                <div class="w-16 h-16 rounded-2xl bg-blue-100 flex items-center justify-center text-3xl p-3">
                    <img src="../../assets/iconos/box-svgrepo-com.svg" alt="caja">
                </div>

            </div>

        </div>


        <!-- GASTADO -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition duration-300">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm uppercase tracking-wide text-gray-400 font-semibold">
                        Gastado Tienda
                    </p>

                    <h3 class="text-4xl font-black mt-2 text-[#e36935e6]">
                        €<?= number_format($totalGastado, 2) ?>
                    </h3>

                </div>

                <div class="w-16 h-16 rounded-2xl bg-green-100 flex items-center justify-center text-3xl">
                    <img src="../assets/iconos/money.svg">
                </div>

            </div>

        </div>


        <!-- DONADO -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition duration-300">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm uppercase tracking-wide text-gray-400 font-semibold">
                        Donaciones
                    </p>

                    <h3 class="text-4xl font-black mt-2 text-pink-500">
                        €<?= number_format($totalDonado, 2) ?>
                    </h3>

                </div>

                <div class="w-16 h-16 rounded-2xl bg-pink-100 flex items-center justify-center text-3xl p-3">
                    <img src="../../assets/iconos/heart-svgrepo-com.svg" alt="corazon">
                </div>

            </div>

        </div>

    </div>


    <!-- ACCIONES RÁPIDAS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        <a href="../controlador/producto_controlador.php"
           class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition flex items-center gap-4">

            <div class="w-14 h-14 rounded-xl bg-orange-100 flex items-center justify-center text-2xl p-3">
                <img src="../../assets/iconos/bag-shopping-svgrepo-com.svg" alt="bolsa de la compra">
            </div>

            <div>

                <h3 class="font-bold text-lg text-gray-800">
                    Ver Productos
                </h3>

                <p class="text-sm text-gray-400">
                    Explora la tienda
                </p>

            </div>

        </a>


        <a href="dinero.php"
           class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition flex items-center gap-4">

            <div class="w-14 h-14 rounded-xl bg-pink-100 flex items-center justify-center text-2xl p-3">
                <img src="../../assets/iconos/heart-svgrepo-com.svg" alt="corazon">
            </div>

            <div>

                <h3 class="font-bold text-lg text-gray-800">
                    Donar
                </h3>

                <p class="text-sm text-gray-400">
                    Ayuda a más personas
                </p>

            </div>

        </a>


        <a href="perfil.php"
           class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition flex items-center gap-4">

            <div class="w-14 h-14 rounded-xl bg-blue-100 flex items-center justify-center text-2xl p-3">
                <img src="../../assets/iconos/person-svgrepo-com.svg" alt="persona">
            </div>

            <div>

                <h3 class="font-bold text-lg text-gray-800">
                    Mi Perfil
                </h3>

                <p class="text-sm text-gray-400">
                    Edita tu cuenta
                </p>

            </div>

        </a>

    </div>


    <!-- PEDIDOS RECIENTES -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        <div class="p-6 border-b border-gray-100 flex items-center justify-between">

            <h2 class="text-2xl font-bold text-gray-800">
                Pedidos recientes
            </h2>

            <a href="mispedidos.php"
               class="text-[#e36935e6] font-semibold hover:underline">
                Ver todos
            </a>

        </div>


        <?php if (count($pedidosRecientes) > 0): ?>

        <div class="overflow-x-auto">

            <table class="table-auto w-full border-collapse">

                <thead>

                    <tr class="bg-gray-50 text-center">

                        <th class="px-4 py-4 border-b">ID</th>
                        <th class="px-4 py-4 border-b">Total</th>
                        <th class="px-4 py-4 border-b">Estado</th>
                        <th class="px-4 py-4 border-b">Fecha</th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach($pedidosRecientes as $pedido): ?>

                    <tr class="border-b text-center hover:bg-gray-50 transition">

                        <td class="px-4 py-4 font-medium">
                            #<?= $pedido['id_pedido'] ?>
                        </td>

                        <td class="px-4 py-4 font-bold text-[#e36935e6]">
                            €<?= number_format($pedido['total'], 2) ?>
                        </td>

                        <td class="px-4 py-4">

                            <span class="px-3 py-1 rounded-full text-xs font-semibold

                            <?= $pedido['estado'] === 'pagado'
                                ? 'bg-green-100 text-green-700'
                                : ($pedido['estado'] === 'pendiente'
                                    ? 'bg-yellow-100 text-yellow-700'
                                    : 'bg-red-100 text-red-700') ?>">

                                <?= ucfirst($pedido['estado']) ?>

                            </span>

                        </td>

                        <td class="px-4 py-4 text-gray-400 text-sm">
                            <?= $pedido['fecha'] ?>
                        </td>

                    </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

        <?php else: ?>

        <div class="p-10 text-center">

            <div class="text-6xl mb-4 text-center">
                <img class="inline-block w-16 h-16 object-contain" src="../../assets/iconos/box-svgrepo-com.svg" alt="caja">
            </div>

            <h3 class="text-xl font-bold text-gray-700 mb-2">
                No tienes pedidos todavía
            </h3>

            <p class="text-gray-400 mb-5">
                Explora nuestros productos y realiza tu primer pedido.
            </p>

            <a href="../controlador/producto_controlador.php"
               class="bg-[#e36935e6] hover:bg-[#ce6538e8] text-white px-6 py-3 rounded-xl font-semibold transition">

                Ver productos

            </a>

        </div>

        <?php endif; ?>

    </div>

</div>

</body>
</html>