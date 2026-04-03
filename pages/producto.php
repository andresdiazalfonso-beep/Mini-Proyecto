<?php
require_once '..\partials\header.php'; 
// Asegúrate de que la ruta al modelo sea correcta según tu estructura
require_once "../admin/modelo/productosmodelo.php"; 
require_once "../Conexion/conexion.php";

// Obtenemos los productos reales de la base de datos
$productos = obtenerProductos($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Donaciones</title>

<link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</head>

<body class="bg-gray-100">

<div class="max-w-7xl mx-auto p-6">

    <!-- TITULO -->
    <h1 class="text-3xl font-bold mb-2">
        Elige lo que quieres donar
    </h1>

    <p class="mb-6 text-gray-600">
        Selecciona productos y añádelos al carrito
    </p>

    <div class="grid grid-cols-3 gap-6">

        <!-- PRODUCTOS -->
        <div class="col-span-2 grid grid-cols-2 gap-4">

            <?php foreach($productos as $p): ?>
                <div class="bg-white p-4 rounded-xl shadow border">

                    <h2 class="font-bold text-lg"><?= $p['nombre'] ?></h2>

                    <p class="text-sm text-gray-500 mb-2">
                        <?= $p['descripcion'] ?>
                    </p>

                    <p class="font-bold text-orange-600 mb-3">
                        €<?= $p['precio'] ?>
                    </p>

                    <!-- BOTÓN AÑADIR -->
                    <form action="carrito.php" method="post">
                        <input type="hidden" name="id_producto" value="<?= $p['id_producto'] ?>">

                        <button class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">
                            Añadir
                        </button>
                    </form>

                </div>
            <?php endforeach; ?>

        </div>

        <!-- CARRITO -->
        <div class="bg-white p-5 rounded-xl shadow h-fit">

            <h2 class="font-bold text-lg mb-4">Tu Donación</h2>

            <!-- Aquí luego metes foreach del carrito -->
            <div class="space-y-2 mb-4">

                <div class="flex justify-between">
                    <span>Producto ejemplo</span>
                    <span>€50</span>
                </div>

            </div>

            <hr class="my-3">

            <div class="flex justify-between font-bold">
                <span>Total:</span>
                <span>€0</span>
            </div>

            <button class="mt-4 w-full bg-orange-500 text-white py-2 rounded hover:bg-orange-600">
                Completar Donación
            </button>

        </div>

    </div>
</div>

</body>
</html>