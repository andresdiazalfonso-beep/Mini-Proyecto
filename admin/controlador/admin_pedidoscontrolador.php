<?php
session_start();

require_once "../modelo/pedidosmodelo.php";
require_once "../../Conexion/conexion.php";

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {

    header("Location: /pages/login.php");
    exit();
}

$pdo = Conexion::conectar();

$modelo = new PedidosModelo($pdo);

$accion = isset($_GET['accion'])
    ? htmlspecialchars(trim($_GET['accion']))
    : "lista";

$id_pedido = isset($_GET['id_pedido'])
    ? intval($_GET['id_pedido'])
    : 0;

$mensaje = $_SESSION['mensaje'] ?? "";
unset($_SESSION['mensaje']);



/* =========================
   PAGINACIÓN
========================= */

$limite = 10;

$pagina = isset($_GET['pagina'])
    ? max(1, intval($_GET['pagina']))
    : 1;

$offset = ($pagina - 1) * $limite;

$totalPedidos = $modelo->contarPedidos();

$totalPaginas = ceil($totalPedidos / $limite);

$pedidos = $modelo->obtenerPedidosPaginados($limite, $offset);



/* =========================
   TARJETAS RESUMEN
========================= */

$totalPendientes = count(array_filter($pedidos, fn($p) => $p['estado'] === 'pendiente'));

$totalPagados = count(array_filter($pedidos, fn($p) => $p['estado'] === 'pagado'));

$totalCancelados = count(array_filter($pedidos, fn($p) => $p['estado'] === 'cancelado'));

$ingresoTotal = array_sum(
    array_column(
        array_filter($pedidos, fn($p) => $p['estado'] === 'pagado'),
        'total'
    )
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

<title>Gestión de Pedidos</title>

</head>

<body class="font-[Poppins] bg-[#f5f5f5]">

<?php require_once "../../partials/nav_admin.php"; ?>

<div class="flex flex-col gap-6">

<div class="p-5 pt-10 ml-0 md:ml-72 mx-4 md:mx-10">

<h1 class="text-3xl font-bold mb-6">
    Pedidos
</h1>


<?php if (!empty($mensaje)): ?>

<p class="font-semibold mb-5 text-sm bg-blue-50 p-3 rounded border-l-4 border-blue-500 text-blue-700">
    <?= htmlspecialchars($mensaje) ?>
</p>

<?php endif; ?>



<!-- TARJETAS -->

<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

    <!-- TOTAL -->

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition duration-300">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-gray-400 uppercase font-semibold tracking-wide">
                    Total Pedidos
                </p>

                <h2 class="text-4xl font-black mt-2 text-gray-800">
                    <?= $totalPedidos ?>
                </h2>

            </div>

            <div class="bg-blue-100 text-3xl w-16 h-16 rounded-2xl flex items-center justify-center">
                📦
            </div>

        </div>

    </div>



    <!-- PENDIENTES -->

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition duration-300">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-gray-400 uppercase font-semibold tracking-wide">
                    Pendientes
                </p>

                <h2 class="text-4xl font-black mt-2 text-yellow-500">
                    <?= $totalPendientes ?>
                </h2>

            </div>

            <div class="bg-yellow-100 text-3xl w-16 h-16 rounded-2xl flex items-center justify-center">
                ⏳
            </div>

        </div>

    </div>



    <!-- PAGADOS -->

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition duration-300">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-gray-400 uppercase font-semibold tracking-wide">
                    Pagados
                </p>

                <h2 class="text-4xl font-black mt-2 text-green-600">
                    <?= $totalPagados ?>
                </h2>

            </div>

            <div class="bg-green-100 text-3xl w-16 h-16 rounded-2xl flex items-center justify-center">
                ✅
            </div>

        </div>

    </div>



    <!-- CANCELADOS -->

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition duration-300">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-gray-400 uppercase font-semibold tracking-wide">
                    Cancelados
                </p>

                <h2 class="text-4xl font-black mt-2 text-red-500">
                    <?= $totalCancelados ?>
                </h2>

            </div>

            <div class="bg-red-100 text-3xl w-16 h-16 rounded-2xl flex items-center justify-center">
                ❌
            </div>

        </div>

    </div>

</div>



<!-- MÓVIL -->

<div class="grid grid-cols-1 sm:grid-cols-2 lg:hidden gap-4">

<?php foreach ($pedidos as $pedido): ?>

<div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col gap-3">

    <div>

        <span class="text-xs text-gray-400 font-mono">
            Pedido #<?= $pedido['id_pedido'] ?>
        </span>

        <h3 class="font-bold text-gray-800">
            <?= htmlspecialchars($pedido['nombre_usuario']) ?>
        </h3>

        <p class="text-sm text-gray-500">
            <?= htmlspecialchars($pedido['email_usuario']) ?>
        </p>

        <p class="text-lg font-bold text-[#e36935e6]">
            <?= number_format($pedido['total'], 2, ',', '.') ?> €
        </p>

        <span class="inline-block mt-2 px-3 py-1 rounded-full text-xs font-semibold

        <?=
            $pedido['estado'] === 'pagado'
            ? 'bg-green-100 text-green-700'
            : ($pedido['estado'] === 'pendiente'
                ? 'bg-yellow-100 text-yellow-700'
                : 'bg-red-100 text-red-700')
        ?>">

            <?= ucfirst($pedido['estado']) ?>

        </span>

        <p class="text-xs text-gray-400 mt-2">
            <?= $pedido['fecha'] ?>
        </p>

    </div>

</div>

<?php endforeach; ?>

</div>



<!-- TABLA DESKTOP -->

<div class="hidden lg:block overflow-x-auto bg-white rounded-xl shadow-sm border border-gray-200">

<table class="table-auto w-full border-collapse">

<thead>

<tr class="bg-gray-100 text-center">

    <th class="px-4 py-3 border-b">ID</th>

    <th class="px-4 py-3 border-b">Cliente</th>

    <th class="px-4 py-3 border-b">Email</th>

    <th class="px-4 py-3 border-b">Total</th>

    <th class="px-4 py-3 border-b">Estado</th>

    <th class="px-4 py-3 border-b">Fecha</th>

    <th class="px-4 py-3 border-b">Acciones</th>

</tr>

</thead>

<tbody>

<?php foreach ($pedidos as $pedido): ?>

<tr class="border-b hover:bg-gray-50 transition-colors text-center">

    <td class="px-4 py-4 font-mono text-sm">
        <?= $pedido['id_pedido'] ?>
    </td>

    <td class="px-4 py-4 font-medium">
        <?= htmlspecialchars($pedido['nombre_usuario']) ?>
    </td>

    <td class="px-4 py-4 text-gray-500 text-sm">
        <?= htmlspecialchars($pedido['email_usuario']) ?>
    </td>

    <td class="px-4 py-4 font-bold text-[#e36935e6]">
        <?= number_format($pedido['total'], 2, ',', '.') ?> €
    </td>

    <td class="px-4 py-4">

        <span class="px-3 py-1 rounded-full text-xs font-semibold

        <?=
            $pedido['estado'] === 'pagado'
            ? 'bg-green-100 text-green-700'
            : ($pedido['estado'] === 'pendiente'
                ? 'bg-yellow-100 text-yellow-700'
                : 'bg-red-100 text-red-700')
        ?>">

            <?= ucfirst($pedido['estado']) ?>

        </span>

    </td>

    <td class="px-4 py-4 text-gray-400 text-sm">
        <?= $pedido['fecha'] ?>
    </td>

    <td class="px-4 py-4">

        <div class="flex justify-center gap-2">

            <form action="" method="get">

                <input type="hidden" name="accion" value="detalle">

                <input type="hidden" name="id_pedido" value="<?= $pedido['id_pedido'] ?>">

                <button type="submit"
                    class="px-3 py-1 bg-blue-500 text-white text-sm font-bold rounded cursor-pointer">

                    Ver

                </button>

            </form>


            <form action="../controlador/admin_pedidoscontrolador.php" method="post">

                <input type="hidden" name="accion" value="eliminar">

                <input type="hidden" name="id_pedido" value="<?= $pedido['id_pedido'] ?>">

                <button type="submit"
                    class="px-3 py-1 bg-red-500 text-white text-sm font-bold rounded cursor-pointer"
                    onclick="return confirm('¿Eliminar pedido?')">

                    Eliminar

                </button>

            </form>

        </div>

    </td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>



<!-- PAGINACIÓN -->

<div class="flex justify-center items-center gap-2 mt-8 flex-wrap">

<?php if ($pagina > 1): ?>

<a href="?pagina=<?= $pagina - 1 ?>"
   class="px-4 py-2 rounded-lg bg-white border hover:bg-gray-100">
    Anterior
</a>

<?php endif; ?>


<?php for ($i = 1; $i <= $totalPaginas; $i++): ?>

<a href="?pagina=<?= $i ?>"
   class="px-4 py-2 rounded-lg border font-semibold

   <?= $i == $pagina
        ? 'bg-[#e36935e6] text-white border-[#e36935e6]'
        : 'bg-white hover:bg-gray-100' ?>">

    <?= $i ?>

</a>

<?php endfor; ?>


<?php if ($pagina < $totalPaginas): ?>

<a href="?pagina=<?= $pagina + 1 ?>"
   class="px-4 py-2 rounded-lg bg-white border hover:bg-gray-100">
    Siguiente
</a>

<?php endif; ?>

</div>


</div>
</div>

</body>
</html>