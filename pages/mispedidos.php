<?php
session_start();
require_once "../conexion/Conexion.php";
require_once "../modelo/MisPedidosModelo.php";

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$usuario = $_SESSION['usuario'];
$pdo     = Conexion::conectar();
$modelo  = new MisPedidosModelo($pdo);

// Paginación
$porPagina = 5;

$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

if ($pagina < 1) {
    $pagina = 1;
}

$totalPedidos = count($modelo->obtenerTodos((int)$usuario['id_usuario']));

$totalPaginas = ceil($totalPedidos / $porPagina);

$offset = ($pagina - 1) * $porPagina;

$pedidos = $modelo->obtenerPaginados(
    (int)$usuario['id_usuario'],
    $porPagina,
    $offset
);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Mis Pedidos</title>
</head>
<body class="bg-[#f5f5f5] font-[Poppins]">

<!-- NAVBAR -->
<nav class="bg-white shadow-sm border-b border-gray-200 px-6 py-4 flex items-center justify-between">
    <div class="flex items-center gap-3">
        <div class="w-11 h-11 rounded-xl bg-[#e36935e6] flex items-center justify-center text-white font-bold text-xl">
            <img src="../assets/iconos/logo.svg">
        </div>
        <div>
            <h1 class="font-bold text-xl text-gray-800">Help4Africa</h1>
            <p class="text-xs text-gray-400">Mis Pedidos</p>
        </div>
    </div>
    <div class="flex items-center gap-4">
        <div class="hidden md:flex flex-col text-right">
            <span class="font-semibold text-gray-700"><?= htmlspecialchars($usuario['nombre']) ?></span>
            <span class="text-sm text-gray-400"><?= htmlspecialchars($usuario['email']) ?></span>
        </div>
        <a href="../controlador/logoutcontrolador.php"
           class="bg-red-500 hover:bg-red-600 transition text-white px-4 py-2 rounded-lg text-sm font-semibold">
            Cerrar sesión
        </a>
    </div>
</nav>

<div class="max-w-7xl mx-auto p-6">

    <!-- CABECERA -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <a href="usuario.php" class="flex items-center gap-1 text-[#e36935e6] font-semibold text-sm mb-2 hover:underline w-fit">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Volver al panel
            </a>
            <h2 class="text-3xl font-black text-gray-800">Mis Pedidos</h2>
            <p class="text-gray-400 mt-1">Historial completo de tus pedidos</p>
        </div>
    </div>

    <!-- TABLA -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        <?php if (count($pedidos) > 0): ?>
        <div class="overflow-x-auto">
            <table class="table-auto w-full border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-center">
                        <th class="px-4 py-4 border-b text-sm font-semibold text-gray-500 uppercase tracking-wide">ID</th>
                        <th class="px-4 py-4 border-b text-sm font-semibold text-gray-500 uppercase tracking-wide">Total</th>
                        <th class="px-4 py-4 border-b text-sm font-semibold text-gray-500 uppercase tracking-wide">Estado</th>
                        <th class="px-4 py-4 border-b text-sm font-semibold text-gray-500 uppercase tracking-wide">Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($pedidos as $pedido): ?>
                    <tr class="border-b text-center hover:bg-gray-50 transition">
                        <td class="px-4 py-4 font-medium text-gray-700">
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
        <?php if ($totalPaginas > 1): ?>

<div class="flex justify-center items-center gap-2 p-6">

    <?php if ($pagina > 1): ?>
        <a href="?pagina=<?= $pagina - 1 ?>"
           class="px-4 py-2 rounded-xl bg-white border border-gray-200 hover:bg-gray-100 transition">
            ←
        </a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>

        <a href="?pagina=<?= $i ?>"
           class="px-4 py-2 rounded-xl font-semibold transition
           <?= $i == $pagina
                ? 'bg-[#e36935e6] text-white'
                : 'bg-white border border-gray-200 hover:bg-gray-100 text-gray-700' ?>">
            <?= $i ?>
        </a>

    <?php endfor; ?>

    <?php if ($pagina < $totalPaginas): ?>
        <a href="?pagina=<?= $pagina + 1 ?>"
           class="px-4 py-2 rounded-xl bg-white border border-gray-200 hover:bg-gray-100 transition">
            →
        </a>
    <?php endif; ?>

</div>

<?php endif; ?>
        <?php else: ?>
        <div class="p-10 text-center">
            <div class="text-6xl mb-4">📦</div>
            <h3 class="text-xl font-bold text-gray-700 mb-2">No tienes pedidos todavía</h3>
            <p class="text-gray-400 mb-5">Explora nuestros productos y realiza tu primer pedido.</p>
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