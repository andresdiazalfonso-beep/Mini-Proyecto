<?php
require_once '../partials/header.php';
require_once "../admin/modelo/productosmodelo.php";
require_once "../Conexion/conexion.php";

$pdo    = Conexion::conectar();
$modelo = new ProductoModelo($pdo);
$productos = $modelo->obtenerProductos();
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

<div class="max-w-7xl mx-auto p-6 mt-20">

    <!-- TITULO -->
    <div class="mb-8">
        <h1 class="text-4xl font-extrabold text-gray-800">
            Haz una donación
        </h1>
        <p class="text-gray-500 mt-2">
            Tu ayuda marca la diferencia ❤️
        </p>
    </div>

    <div class="grid lg:grid-cols-3 gap-8">

        <!-- PRODUCTOS -->
        <div class="lg:col-span-2 grid sm:grid-cols-2 gap-6">

            <?php foreach($productos as $p): ?>
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 p-5 flex flex-col justify-between">

                    <!-- Imagen -->
                    <div class="h-40 w-full bg-gray-100 rounded-lg mb-4 overflow-hidden">
                        <img src="data:image/*;base64,<?= base64_encode($p['imagen']) ?>" class="w-full h-full object-cover">
                    </div>

                    <div>
                        <h2 class="font-bold text-xl text-gray-800">
                            <?= $p['nombre'] ?>
                        </h2>

                        <p class="text-sm text-gray-500 mt-1 mb-3">
                            <?= $p['descripcion'] ?>
                        </p>

                        <p class="font-bold text-orange-500 text-lg mb-4">
                            €<?= $p['precio'] ?>
                        </p>
                    </div>

                    <!-- BOTÓN -->
                    <form action="carrito.php" method="post">
                        <input type="hidden" name="id_producto" value="<?= $p['id_producto'] ?>">

                        <button class="w-full bg-orange-500 text-white py-2 rounded-lg font-semibold hover:bg-orange-600 transition">
                            Añadir al carrito
                        </button>
                    </form>

                </div>
            <?php endforeach; ?>

        </div>

        <!-- CARRITO -->
        <div class="bg-white p-6 rounded-2xl shadow-lg sticky top-24 h-fit">

            <h2 class="text-xl font-bold mb-4 text-gray-800">
                Tu Donación
            </h2>

            <!-- Productos carrito -->
            <div class="space-y-3 mb-4">

                <div class="flex justify-between items-center bg-gray-50 p-2 rounded">
                    <span class="text-sm">Producto ejemplo</span>
                    <span class="font-semibold">€50</span>
                </div>

            </div>

            <hr class="my-4">

            <!-- Total -->
            <div class="flex justify-between text-lg font-bold">
                <span>Total:</span>
                <span class="text-orange-500">€0</span>
            </div>

            
            <button class="mt-5 w-full bg-orange-500 text-white py-3 rounded-xl font-bold hover:bg-orange-600 transition">
                Completar Donación
            </button>

        </div>

    </div>
</div>

</body>
</html>