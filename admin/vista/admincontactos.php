<?php

$mensaje        = $mensaje        ?? "";
$contactos      = $contactos      ?? [];
$totalContactos = $totalContactos ?? 0;
$totalPaginas   = $totalPaginas   ?? 1;
$paginaActual   = $paginaActual   ?? 1;
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<title>Mensajes de Contacto</title>

</head>

<body class="font-[Poppins] bg-[#f5f5f5]">

<?php require_once "../../partials/nav_admin.php"; ?>

<div class="flex flex-col gap-6">

<div class="p-5 pt-10 ml-0 md:ml-72 mx-4 md:mx-10">

<h1 class="text-3xl font-bold mb-6">
    Mensajes de Contacto
</h1>

<?php if(!empty($mensaje)): ?>

<p class="font-semibold mb-5 text-sm bg-blue-50 p-3 rounded border-l-4 border-blue-500 text-blue-700">
    <?= htmlspecialchars($mensaje) ?>
</p>

<?php endif; ?>



<!-- TARJETA RESUMEN -->

<div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">

    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition duration-300">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-gray-400 uppercase font-semibold tracking-wide">
                    Total Mensajes
                </p>

                <h2 class="text-4xl font-black mt-2 text-gray-800">
                    <?= $totalContactos ?>
                </h2>

            </div>

            <div class="bg-blue-100 text-3xl w-16 h-16 rounded-2xl flex items-center justify-center">
                ✉️
            </div>

        </div>

    </div>

</div>



<!-- TABLA -->

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

    <div class="overflow-x-auto">

        <table class="w-full text-sm">

            <thead class="bg-gray-50 text-gray-500 uppercase text-xs tracking-wider">
                <tr>
                    <th class="px-6 py-4 text-left">ID</th>
                    <th class="px-6 py-4 text-left">Nombre</th>
                    <th class="px-6 py-4 text-left">Email</th>
                    <th class="px-6 py-4 text-left">Asunto</th>
                    <th class="px-6 py-4 text-left">Mensaje</th>
                    <th class="px-6 py-4 text-left">Fecha</th>
                    <th class="px-6 py-4 text-left">Acción</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">

            <?php if (empty($contactos)): ?>

                <tr>
                    <td colspan="7" class="px-6 py-10 text-center text-gray-400">
                        No hay mensajes registrados
                    </td>
                </tr>

            <?php else: ?>

                <?php foreach ($contactos as $contacto): ?>

                <tr class="hover:bg-gray-50 transition">

                    <td class="px-6 py-4 text-gray-500">
                        #<?= $contacto['id_contacto'] ?>
                    </td>

                    <td class="px-6 py-4 font-medium text-gray-800">
                        <?= htmlspecialchars($contacto['nombre']) ?>
                    </td>

                    <td class="px-6 py-4 text-gray-600">
                        <?= htmlspecialchars($contacto['email']) ?>
                    </td>

                    <td class="px-6 py-4 text-gray-600">
                        <?= htmlspecialchars($contacto['asunto'] ?: '—') ?>
                    </td>

                    <td class="px-6 py-4 text-gray-600 max-w-xs">
                        <span title="<?= htmlspecialchars($contacto['mensaje']) ?>">
                            <?= htmlspecialchars(mb_strimwidth($contacto['mensaje'], 0, 60, '…')) ?>
                        </span>
                    </td>

                    <td class="px-6 py-4 text-gray-500">
                        <?= date('d/m/Y H:i', strtotime($contacto['fecha'])) ?>
                    </td>

                    <td class="px-6 py-4">

                        <form method="POST"
                              action="/admin/controlador/admin_contactoscontrolador.php"
                              onsubmit="return confirm('¿Eliminar este mensaje?')">

                            <input type="hidden" name="accion"      value="eliminar">
                            <input type="hidden" name="id_contacto" value="<?= $contacto['id_contacto'] ?>">

                            <button type="submit"
                                    class="bg-red-100 text-red-600 hover:bg-red-200 px-3 py-1.5 rounded-lg text-xs font-semibold transition">
                                Eliminar
                            </button>

                        </form>

                    </td>

                </tr>

                <?php endforeach; ?>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>



<!-- PAGINACIÓN -->

<?php if ($totalPaginas > 1): ?>

<div class="flex justify-center gap-2 mt-6">

    <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>

        <a href="?pagina=<?= $i ?>"
           class="px-4 py-2 rounded-lg text-sm font-semibold transition
                  <?= $i === $paginaActual
                      ? 'bg-[#3d120d] text-white'
                      : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50' ?>">
            <?= $i ?>
        </a>

    <?php endfor; ?>

</div>

<?php endif; ?>

</div>

</div>

</body>

</html>