<?php
session_start();
require_once "../modelo/pedidosmodelo.php";
require_once "../../Conexion/conexion.php";

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header("Location: /pages/login.php");
    exit();
}

$pdo    = Conexion::conectar();
$modelo = new PedidosModelo($pdo);

$accion    = isset($_GET['accion'])    ? htmlspecialchars(trim($_GET['accion'])) : "lista";
$id_pedido = isset($_GET['id_pedido']) ? intval($_GET['id_pedido'])               : 0;

$mensaje = $_SESSION['mensaje'] ?? "";
unset($_SESSION['mensaje']);

$pedidos = $modelo->obtenerPedidos();

// Totales por estado para las tarjetas
$totalPendientes = count(array_filter($pedidos, fn($p) => $p['estado'] === 'pendiente'));
$totalPagados    = count(array_filter($pedidos, fn($p) => $p['estado'] === 'pagado'));
$totalCancelados = count(array_filter($pedidos, fn($p) => $p['estado'] === 'cancelado'));
$ingresoTotal    = array_sum(array_column(array_filter($pedidos, fn($p) => $p['estado'] === 'pagado'), 'total'));
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Gestión de Pedidos</title>
</head>
<body class="font-[Poppins] bg-[#f5f5f5]">
<?php require_once "../../partials/nav_admin.php"; ?>

<div class="flex flex-col gap-6">
<div class="p-5 pt-10 ml-0 md:ml-72 mx-4 md:mx-10">

    <h1 class="text-3xl font-bold mb-6">Pedidos</h1>

    <?php if (!empty($mensaje)): ?>
        <p class="font-semibold mb-5 text-sm bg-blue-50 p-3 rounded border-l-4 border-blue-500 text-blue-700">
            <?= htmlspecialchars($mensaje) ?>
        </p>
    <?php endif; ?>


    <?php if ($accion === "detalle" && $id_pedido > 0):
        $pedido  = $modelo->obtenerPedidoPorId($id_pedido);
        $detalle = $modelo->obtenerDetallePedido($id_pedido);
        if ($pedido): ?>

    <div class="bg-white p-6 rounded-lg shadow mb-8 border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-semibold text-xl">Pedido #<?= $pedido['id_pedido'] ?></h2>
            <a href="?accion=lista" class="btn btn-sm btn-outline">← Volver</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 text-sm">
            <div>
                <p class="text-gray-400 uppercase font-semibold mb-1">Cliente</p>
                <p class="font-medium"><?= htmlspecialchars($pedido['nombre_usuario']) ?></p>
                <p class="text-gray-500"><?= htmlspecialchars($pedido['email_usuario']) ?></p>
            </div>
            <div>
                <p class="text-gray-400 uppercase font-semibold mb-1">Información</p>
                <p>Fecha: <span class="font-medium"><?= htmlspecialchars($pedido['fecha']) ?></span></p>
                <p>Total: <span class="font-bold text-[#e36935e6]"><?= number_format($pedido['total'], 2, ',', '.') ?> €</span></p>
                <p>Estado:
                    <span class="px-2 py-0.5 rounded-full text-xs font-semibold
                        <?= $pedido['estado'] === 'pagado'    ? 'bg-green-100 text-green-700' :
                           ($pedido['estado'] === 'pendiente' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') ?>">
                        <?= ucfirst($pedido['estado']) ?>
                    </span>
                </p>
            </div>
        </div>

        <!-- Cambiar estado -->
        <form action="../controlador/admin_pedidoscontrolador.php" method="post" class="flex flex-wrap items-center gap-3 mb-6">
            <input type="hidden" name="accion"    value="cambiar_estado">
            <input type="hidden" name="id_pedido" value="<?= $pedido['id_pedido'] ?>">
            <select name="estado" class="select select-bordered select-sm">
                <option value="pendiente"  <?= $pedido['estado'] === 'pendiente'  ? 'selected' : '' ?>>Pendiente</option>
                <option value="pagado"     <?= $pedido['estado'] === 'pagado'     ? 'selected' : '' ?>>Pagado</option>
                <option value="cancelado"  <?= $pedido['estado'] === 'cancelado'  ? 'selected' : '' ?>>Cancelado</option>
            </select>
            <button type="submit" class="btn btn-sm bg-[#e36935e6] text-white hover:bg-[#ce6538e8]">
                Actualizar Estado
            </button>
        </form>

        <!-- Detalle de productos -->
        <h3 class="font-semibold text-lg mb-3">Productos del Pedido</h3>
        <div class="overflow-x-auto">
            <table class="table-auto w-full border-collapse text-sm">
                <thead>
                    <tr class="bg-gray-100 text-center">
                        <th class="px-4 py-2 border-b">Producto</th>
                        <th class="px-4 py-2 border-b">Cantidad</th>
                        <th class="px-4 py-2 border-b">Precio Unit.</th>
                        <th class="px-4 py-2 border-b">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($detalle as $item): ?>
                    <tr class="border-b hover:bg-gray-50 text-center">
                        <td class="px-4 py-3 font-medium"><?= htmlspecialchars($item['nombre']) ?></td>
                        <td class="px-4 py-3"><?= $item['cantidad'] ?></td>
                        <td class="px-4 py-3"><?= number_format($item['precio_unitario'], 2, ',', '.') ?> €</td>
                        <td class="px-4 py-3 font-bold">
                            <?= number_format($item['precio_unitario'] * $item['cantidad'], 2, ',', '.') ?> €
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php endif; endif; ?>


    <!-- TARJETAS RESUMEN -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-400 uppercase font-semibold tracking-wide">Total Pedidos</p>
                    <h2 class="text-4xl font-black mt-2 text-gray-800"><?= count($pedidos) ?></h2>
                </div>
                <div class="bg-blue-100 text-3xl w-16 h-16 rounded-2xl flex items-center justify-center">📦</div>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-400 uppercase font-semibold tracking-wide">Pendientes</p>
                    <h2 class="text-4xl font-black mt-2 text-yellow-500"><?= $totalPendientes ?></h2>
                </div>
                <div class="bg-yellow-100 text-3xl w-16 h-16 rounded-2xl flex items-center justify-center">⏳</div>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-400 uppercase font-semibold tracking-wide">Pagados</p>
                    <h2 class="text-4xl font-black mt-2 text-green-600"><?= $totalPagados ?></h2>
                </div>
                <div class="bg-green-100 text-3xl w-16 h-16 rounded-2xl flex items-center justify-center">✅</div>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-400 uppercase font-semibold tracking-wide">Ingresos</p>
                    <h2 class="text-3xl font-black mt-2 text-[#e36935e6]">
                        <?= number_format($ingresoTotal, 2, ',', '.') ?> €
                    </h2>
                </div>
                <div class="bg-orange-100 text-3xl w-16 h-16 rounded-2xl flex items-center justify-center">💰</div>
            </div>
        </div>
    </div>


    <!-- TARJETAS MÓVIL -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:hidden gap-4">
        <?php foreach ($pedidos as $pedido): ?>
        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col gap-3">
            <div>
                <span class="text-xs text-gray-400 font-mono">Pedido #<?= $pedido['id_pedido'] ?></span>
                <h3 class="font-bold text-gray-800"><?= htmlspecialchars($pedido['nombre_usuario']) ?></h3>
                <p class="text-sm text-gray-500"><?= htmlspecialchars($pedido['email_usuario']) ?></p>
                <p class="text-lg font-bold text-[#e36935e6]"><?= number_format($pedido['total'], 2, ',', '.') ?> €</p>
                <span class="inline-block mt-1 px-2 py-0.5 rounded-full text-xs font-semibold
                    <?= $pedido['estado'] === 'pagado'    ? 'bg-green-100 text-green-700' :
                       ($pedido['estado'] === 'pendiente' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') ?>">
                    <?= ucfirst($pedido['estado']) ?>
                </span>
            </div>
            <div class="flex gap-2">
                <form action="" method="get" class="flex-1">
                    <input type="hidden" name="accion"    value="detalle">
                    <input type="hidden" name="id_pedido" value="<?= $pedido['id_pedido'] ?>">
                    <button class="btn btn-sm w-full bg-blue-500 text-white text-xs p-4">Ver</button>
                </form>
                <form action="../controlador/admin_pedidoscontrolador.php" method="post" class="flex-1">
                    <input type="hidden" name="accion"    value="eliminar">
                    <input type="hidden" name="id_pedido" value="<?= $pedido['id_pedido'] ?>">
                    <button class="btn btn-sm w-full bg-red-500 text-white text-xs p-4"
                            onclick="return confirm('¿Seguro que quieres eliminar este pedido?')">
                        Eliminar
                    </button>
                </form>
            </div>
        </div>
        <?php endforeach; ?>
    </div>


    <!-- TABLA ESCRITORIO -->
    <div class="hidden lg:block overflow-x-auto bg-white rounded-xl shadow-sm border border-gray-200 pb-20">
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
                    <td class="px-4 py-4 font-mono text-sm"><?= $pedido['id_pedido'] ?></td>
                    <td class="px-4 py-4 font-medium"><?= htmlspecialchars($pedido['nombre_usuario']) ?></td>
                    <td class="px-4 py-4 text-gray-500 text-sm"><?= htmlspecialchars($pedido['email_usuario']) ?></td>
                    <td class="px-4 py-4 font-bold text-[#e36935e6]">
                        <?= number_format($pedido['total'], 2, ',', '.') ?> €
                    </td>
                    <td class="px-4 py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            <?= $pedido['estado'] === 'pagado'    ? 'bg-green-100 text-green-700' :
                               ($pedido['estado'] === 'pendiente' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') ?>">
                            <?= ucfirst($pedido['estado']) ?>
                        </span>
                    </td>
                    <td class="px-4 py-4 text-gray-400 text-sm"><?= htmlspecialchars($pedido['fecha']) ?></td>
                    <td class="px-4 py-4">
                        <div class="flex gap-2 items-center justify-center">
                            <form action="" method="get">
                                <input type="hidden" name="accion"    value="detalle">
                                <input type="hidden" name="id_pedido" value="<?= $pedido['id_pedido'] ?>">
                                <button type="submit" class="px-3 py-1 bg-blue-500 text-white text-sm font-bold rounded cursor-pointer">
                                    Ver
                                </button>
                            </form>
                            <form action="../controlador/admin_pedidoscontrolador.php" method="post">
                                <input type="hidden" name="accion"    value="eliminar">
                                <input type="hidden" name="id_pedido" value="<?= $pedido['id_pedido'] ?>">
                                <button type="submit"
                                        class="px-3 py-1 bg-red-500 text-white text-sm font-bold rounded cursor-pointer"
                                        onclick="return confirm('¿Seguro que quieres eliminar este pedido?')">
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

</div>
</div>
</body>
</html>
