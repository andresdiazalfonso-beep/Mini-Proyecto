<?php
session_start();

require_once "../../conexion/Conexion.php";

$pdo = Conexion::conectar();


// ==========================
// ESTADÍSTICAS GENERALES
// ==========================

// TOTAL USUARIOS
$stmt = $pdo->query("
    SELECT COUNT(*) as total 
    FROM usuarios
");

$totalUsuarios = $stmt->fetch()['total'];


// TOTAL PEDIDOS
$stmt = $pdo->query("
    SELECT COUNT(*) as total 
    FROM pedidos
");

$totalPedidos = $stmt->fetch()['total'];


// INGRESOS
$stmt = $pdo->query("
    SELECT SUM(total) as ingresos 
    FROM pedidos 
    WHERE estado = 'pagado'
");

$ingresos = $stmt->fetch()['ingresos'] ?? 0;


// PEDIDOS PAGADOS
$stmt = $pdo->query("
    SELECT COUNT(*) as total 
    FROM pedidos 
    WHERE estado = 'pagado'
");

$pedidosPagados = $stmt->fetch()['total'];


// ==========================
// PRODUCTOS MÁS VENDIDOS
// ==========================

$stmt = $pdo->query("
    SELECT 
        p.nombre,
        SUM(dp.cantidad) as vendidos
    FROM detalle_pedido dp
    INNER JOIN productos p 
        ON dp.id_producto = p.id_producto
    GROUP BY p.id_producto
    ORDER BY vendidos DESC
    LIMIT 5
");

$productosMasVendidos = $stmt->fetchAll();


// ==========================
// VENTAS MENSUALES
// ==========================

$stmt = $pdo->query("
    SELECT 
        MONTH(fecha) as mes,
        SUM(total) as total
    FROM pedidos
    WHERE estado = 'pagado'
    GROUP BY MONTH(fecha)
    ORDER BY mes
");

$ventasMensuales = $stmt->fetchAll(PDO::FETCH_ASSOC);

$meses = [];
$totales = [];

foreach($ventasMensuales as $venta){

    $meses[] = $venta['mes'];
    $totales[] = $venta['total'];
}


// ==========================
// ESTADO PEDIDOS
// ==========================

$stmt = $pdo->query("
    SELECT 
        estado,
        COUNT(*) as total
    FROM pedidos
    GROUP BY estado
");

$estados = [];
$totalesEstados = [];

while($fila = $stmt->fetch()){

    $estados[] = $fila['estado'];
    $totalesEstados[] = $fila['total'];
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard ONG</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body class="font-[Poppins] bg-[#f5f5f5]">
<?php require_once "../../partials/nav_admin.php";?>

<!-- CONTENIDO -->
<div class="flex flex-col gap-6">

<div class="p-5 pt-10 ml-0 md:ml-72 mx-4 md:mx-10">


<!-- HEADER -->
<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-10">

    <div>

        <h1 class="text-4xl md:text-5xl font-extrabold text-[#e36935e6] mb-3">
            Dashboard Solidario
        </h1>

        <p class="text-gray-500 text-lg">
            Estadísticas generales de la ONG
        </p>

    </div>

</div>



<!-- TARJETAS -->

<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-12">

    <!-- USUARIOS -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition duration-300">

        <div class="flex items-center justify-between mb-5">

            <div>

                <p class="text-sm text-gray-400 uppercase font-semibold tracking-wide">
                    Usuarios
                </p>

                <h2 class="text-4xl font-black mt-2 text-gray-800">
                    <?= $totalUsuarios ?>
                </h2>

            </div>

            <div class="bg-orange-100 text-3xl w-16 h-16 rounded-2xl flex items-center justify-center">
                👥
            </div>

        </div>

    </div>



    <!-- PEDIDOS -->

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition duration-300">

        <div class="flex items-center justify-between mb-5">

            <div>

                <p class="text-sm text-gray-400 uppercase font-semibold tracking-wide">
                    Pedidos
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



    <!-- DONACIONES -->

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition duration-300">

        <div class="flex items-center justify-between mb-5">

            <div>

                <p class="text-sm text-gray-400 uppercase font-semibold tracking-wide">
                    Donaciones
                </p>

                <h2 class="text-4xl font-black mt-2 text-[#e36935e6]">
                    <?= number_format($ingresos, 2,",",".")."€" ?>
                </h2>

            </div>

            <div class="bg-red-100 text-3xl w-16 h-16 rounded-2xl flex items-center justify-center">
                ❤️
            </div>

        </div>

    </div>



    <!-- PAGADOS -->

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition duration-300">

        <div class="flex items-center justify-between mb-5">

            <div>

                <p class="text-sm text-gray-400 uppercase font-semibold tracking-wide">
                    Pagados
                </p>

                <h2 class="text-4xl font-black mt-2 text-green-600">
                    <?= $pedidosPagados ?>
                </h2>

            </div>

            <div class="bg-green-100 text-3xl w-16 h-16 rounded-2xl flex items-center justify-center">
                ✅
            </div>

        </div>

    </div>

</div>



<!-- PRODUCTOS MÁS VENDIDOS -->

<div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 overflow-x-auto mb-10">

    <div class="flex items-center justify-between mb-6">

        <h2 class="text-2xl font-bold text-gray-800">
            Productos Más Vendidos
        </h2>

        <span class="bg-[#e36935e6] text-white px-4 py-2 rounded-xl text-sm font-bold">
            TOP 5
        </span>

    </div>


    <table class="table-auto w-full border-collapse">

        <thead>

            <tr class="bg-gray-100 text-center">

                <th class="px-4 py-3 border-b">
                    Producto
                </th>

                <th class="px-4 py-3 border-b">
                    Vendidos
                </th>

            </tr>

        </thead>


        <tbody>

        <?php foreach($productosMasVendidos as $producto): ?>

            <tr class="border-b hover:bg-gray-50 transition-colors text-center">

                <td class="px-4 py-4 font-medium">
                    <?= htmlspecialchars($producto['nombre']) ?>
                </td>

                <td class="px-4 py-4 font-bold text-[#e36935e6]">
                    <?= $producto['vendidos'] ?>
                </td>

            </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

</div>




<!-- GRAFICOS -->

<div class="grid grid-cols-1 xl:grid-cols-2 gap-8 pb-20">


    <!-- GRAFICO VENTAS -->

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

        <h2 class="text-2xl font-bold text-gray-800 mb-6">
            Ventas Mensuales
        </h2>

        <div class="h-[320px]">

            <canvas id="ventasChart"></canvas>

        </div>

    </div>



    <!-- GRAFICO PEDIDOS -->

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

        <h2 class="text-2xl font-bold text-gray-800 mb-6">
            Estado de Pedidos
        </h2>

        <div class="h-[320px] flex items-center justify-center">

            <canvas id="pedidosChart"></canvas>

        </div>

    </div>

</div>

</div>
</div>





<!-- CHART VENTAS -->

<script>

const ventasCtx = document.getElementById('ventasChart');

new Chart(ventasCtx, {

    type: 'bar',

    data: {

        labels: <?= json_encode($meses) ?>,

        datasets: [{

            label: 'Ventas (€)',

            data: <?= json_encode($totales) ?>,

            backgroundColor: '#e36935e6',

            borderRadius: 12,

            borderSkipped: false

        }]
    },

    options: {

        responsive: true,

        maintainAspectRatio: false,

        plugins: {

            legend: {
                display: false
            }

        },

        scales: {

            y: {

                beginAtZero: true,

                grid: {
                    color: '#f1f1f1'
                }

            },

            x: {

                grid: {
                    display: false
                }

            }

        }

    }

});

</script>





<!-- CHART PEDIDOS -->

<script>

const pedidosCtx = document.getElementById('pedidosChart');

new Chart(pedidosCtx, {

    type: 'doughnut',

    data: {

        labels: <?= json_encode($estados) ?>,

        datasets: [{

            data: <?= json_encode($totalesEstados) ?>,

            backgroundColor: [

                '#22c55e',
                '#f59e0b',
                '#ef4444'

            ],

            borderWidth: 0

        }]
    },

    options: {

        responsive: true,

        maintainAspectRatio: false,

        cutout: '70%'

    }

});

</script>

</body>
</html>