<?php

$mensaje = $mensaje ?? "";

$donaciones = $donaciones ?? [];

$totalDonaciones = $totalDonaciones ?? 0;

$totalIngresos = $totalIngresos ?? 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<title>Donaciones</title>
</head>
<body class="font-[Poppins] bg-[#f5f5f5]">

<?php require_once "../../partials/nav_admin.php"; ?>

<div class="flex flex-col gap-6">

<div class="p-5 pt-10 ml-0 md:ml-72 mx-4 md:mx-10">

<h1 class="text-3xl font-bold mb-6">
    Donaciones
</h1>

<?php if(!empty($mensaje)): ?>

<p class="font-semibold mb-5 text-sm bg-blue-50 p-3 rounded border-l-4 border-blue-500 text-blue-700">
    <?= htmlspecialchars($mensaje) ?>
</p>

<?php endif; ?>



<!-- TARJETAS -->

<div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition duration-300">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-gray-400 uppercase font-semibold tracking-wide">
                    Total Donaciones
                </p>

                <h2 class="text-4xl font-black mt-2 text-gray-800">
                    <?= $totalDonaciones ?>
                </h2>

            </div>

            <div class="bg-orange-100 text-3xl w-16 h-16 rounded-2xl flex items-center justify-center">
                ❤️
            </div>

        </div>

    </div>


    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition duration-300">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-gray-400 uppercase font-semibold tracking-wide">
                    Total Recaudado
                </p>

                <h2 class="text-4xl font-black mt-2 text-[#e36935e6]">
                    €<?= number_format($totalIngresos, 2) ?>
                </h2>

            </div>

            <div class="bg-green-100 text-3xl w-16 h-16 rounded-2xl flex items-center justify-center">
                💰
            </div>

        </div>

    </div>

</div>



<!-- MÓVIL -->

<div class="grid grid-cols-1 sm:grid-cols-2 lg:hidden gap-4">

<?php foreach($donaciones as $donacion): ?>

<div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col gap-3">

    <div>

        <span class="text-xs text-gray-400 font-mono">
            Donación #<?= $donacion['id_donacion'] ?>
        </span>

        <h3 class="font-bold text-gray-800">
            <?= htmlspecialchars($donacion['nombre']) ?>
        </h3>

        <p class="text-sm text-gray-500">
            <?= htmlspecialchars($donacion['email']) ?>
        </p>

        <p class="text-lg font-bold text-[#e36935e6]">
            €<?= number_format($donacion['cantidad'], 2) ?>
        </p>

        <span class="inline-block mt-1 px-2 py-0.5 rounded-full text-xs font-semibold
            <?= $donacion['estado'] === 'pagado'
                ? 'bg-green-100 text-green-700'
                : 'bg-red-100 text-red-700' ?>">

            <?= ucfirst($donacion['estado']) ?>

        </span>

        <p class="text-sm text-gray-400 mt-2">
            <?= date("d/m/Y H:i", strtotime($donacion['fecha'])) ?>
        </p>

    </div>

    <form action="../controlador/admin_donacionescontrolador.php" method="post">

        <input type="hidden" name="accion" value="eliminar">

        <input type="hidden" name="id_donacion" value="<?= $donacion['id_donacion'] ?>">

        <button class="btn btn-sm w-full bg-red-500 text-white"
            onclick="return confirm('¿Eliminar donación?')">

            Eliminar

        </button>

    </form>

</div>

<?php endforeach; ?>

</div>



<!-- TABLA DESKTOP -->

<div class="hidden lg:block overflow-x-auto bg-white rounded-xl shadow-sm border border-gray-200">

<table class="table-auto w-full border-collapse">

<thead>
<tr class="bg-gray-100 text-center">

    <th class="px-4 py-3 border-b">ID</th>

    <th class="px-4 py-3 border-b">Usuario</th>

    <th class="px-4 py-3 border-b">Email</th>

    <th class="px-4 py-3 border-b">Cantidad</th>

    <th class="px-4 py-3 border-b">Estado</th>

    <th class="px-4 py-3 border-b">Fecha</th>

    <th class="px-4 py-3 border-b">Acciones</th>

</tr>
</thead>

<tbody>

<?php foreach($donaciones as $donacion): ?>

<tr class="border-b hover:bg-gray-50 transition-colors text-center">

    <td class="px-4 py-4">
        <?= $donacion['id_donacion'] ?>
    </td>

    <td class="px-4 py-4 font-medium">
        <?= htmlspecialchars($donacion['nombre']) ?>
    </td>

    <td class="px-4 py-4 text-gray-500 text-sm">
        <?= htmlspecialchars($donacion['email']) ?>
    </td>

    <td class="px-4 py-4 font-bold text-[#e36935e6]">
        €<?= number_format($donacion['cantidad'], 2) ?>
    </td>

    <td class="px-4 py-4">

    <span class="px-3 py-1 rounded-full text-xs font-semibold

    <?=
        $donacion['estado'] === 'pagado'
            ? 'bg-green-100 text-green-700'

        : ($donacion['estado'] === 'pendiente'
            ? 'bg-yellow-100 text-yellow-700'

            : 'bg-red-100 text-red-700')
    ?>">

        <?= ucfirst($donacion['estado']) ?>

    </span>

    </td>

    <td class="px-4 py-4 text-gray-400 text-sm">
        <?= date("d/m/Y H:i", strtotime($donacion['fecha'])) ?>
    </td>

    <td class="px-4 py-4">

        <form action="../controlador/admin_donacionescontrolador.php"
              method="post">

            <input type="hidden" name="accion" value="eliminar">

            <input type="hidden" name="id_donacion"
                   value="<?= $donacion['id_donacion'] ?>">

            <button type="submit"
                class="px-3 py-1 bg-red-500 text-white text-sm font-bold rounded cursor-pointer"
                onclick="return confirm('¿Eliminar donación?')">

                Eliminar

            </button>

        </form>

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