<?php
require_once '../partials/header.php';
require_once "../admin/modelo/ProductosModelo.php";
require_once "../conexion/Conexion.php";

$pdo    = Conexion::conectar();
$modelo = new ProductoModelo($pdo);
$productos = $modelo->obtenerProductos();

$carrito = $_SESSION['carrito']->getCarrito();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Donaciones</title>

<link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</head>

<body class="bg-[#f8f4f1] font-[Poppins]">
<div class="max-w-7xl mx-auto p-6 mt-18 pt-10">

    <!-- TITULO -->
    <div class="mb-8">
        <h1 class="text-4xl font-extrabold text-gray-800">
            Haz una donación
        </h1>
        <p class="text-gray-500 mt-2">
            Tu ayuda marca la diferencia ❤️
        </p>
    </div>

    <?php if(isset($_SESSION['mensaje'])): ?>
        <div class="mb-4 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 shadow-sm flex items-center gap-2">
            <?= $_SESSION['mensaje'] ?>
        </div>
        <?php unset($_SESSION['mensaje']); ?>
    <?php endif; ?>

    <?php if(isset($_SESSION['errores'])): ?>
        <?php foreach($_SESSION['errores'] as $error): ?>
            <div class="mb-4 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 shadow-sm flex items-center gap-2">
                <?= $error ?>
            </div>
        <?php endforeach; ?>
        <?php unset($_SESSION['errores']); ?>
    <?php endif; ?>


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

                        <p class="font-bold text-[#e36935e6] text-lg mb-4">
                            €<?= $p['precio'] ?>
                        </p>
                    </div>

                    <!-- BOTÓN -->
                    <form action="../controlador/producto_controlador.php" method="post">
                        <input type="hidden" name="producto_id" value="<?= $p['id_producto'] ?>">
                        <input type="hidden" name="accion" value="añadir">

                        <button class="w-full bg-[#e36935e6] text-white py-2 rounded-lg font-semibold hover:bg-[#e36935e6]/90 transition">
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

                <?php foreach($carrito as $c): ?>

                    <div class="flex justify-between items-center bg-gray-50 p-2 rounded">

    <span class="text-sm">
        <?= $c['producto']->getNombre() ?> x <?= $c['cantidad'] ?>
    </span>

    <div class="flex items-center gap-3">

        <span class="font-semibold">
            <?= number_format($c['producto']->calcularPrecioFinal($c['cantidad']),2,",",".") ?>€
        </span>

        <form action="../controlador/producto_controlador.php" method="post">
            <input type="hidden" name="accion" value="eliminar">
            <input type="hidden" name="producto_id" value="<?= $c['producto']->getId() ?>">

            <button type="submit"
                class="group flex items-center justify-center w-8 h-8 rounded-full 
                    bg-gray-100 hover:bg-red-500 transition duration-300">

                <img src="../assets/iconos/cross.svg"
                    class="w-4 h-4 group-hover:invert transition duration-300">
            </button>
        </form>

        </div>
                
    </div>

                <?php endforeach; ?>

            </div>

            <hr class="my-4">

            <!-- Total -->
            <div class="flex justify-between text-lg font-bold">
                <span>Total:</span>
                <span class="text-[#e36935e6]"><?= number_format($_SESSION['carrito']->calcularTotal(),2,",",".")."€" ?></span>
            </div>

            <form action="../controlador/producto_controlador.php" method="post">
                <input type="hidden" name="accion" value="checkout">
                <button class="mt-5 w-full bg-[#e36935e6] text-white py-3 rounded-xl font-bold hover:bg-[#e36935e6]/90 transition">
                    Completar Donación
                </button>
            </form>

        </div>

    </div>
</div>

</body>
</html>