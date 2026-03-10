<?php
session_start();
require_once "../modelo/productosmodelo.php";

$mensaje = $_SESSION['mensaje'] ?? "";
unset($_SESSION['mensaje']);

$productos = obtenerProductos();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Document</title>
</head>
<body class="font-[Poppins]">
    <div class="p-5 mx-60 pt-16">
    <h1 class="text-3xl font-bold mb-6">Productos</h1>

    <!-- Formulario Agregar Producto -->
    <div class="bg-white p-5 rounded-lg shadow mb-10">
        <h2 class="font-semibold text-xl mb-3">Agregar Nuevo Producto</h2>
        <form action="../controlador/productocontrolador.php" method="post" enctype="multipart/form-data" class="space-y-3">
    
    <input type="hidden" name="accion" value="agregar">

    <input type="text" name="nombre" placeholder="Nombre" class="input input-bordered w-full" required>

    <input type="text" name="descripcion" placeholder="Descripción" class="input input-bordered w-full" required>

    <input type="number" step="0.01" name="precio" placeholder="Precio" class="input input-bordered w-full" required>

    <input type="file" name="imagen" class="w-full">

    <input type="submit" value="Agregar Producto" name="" class="btn bg-green-500 text-white hover:bg-green-600 mt-2">

</form>
</div>
    </div>

<div class="p-1 mx-40">
    <?php if(!empty($mensaje)): ?>
        <p class="font-semibold mb-3 text-sm"><?= $mensaje ?></p>
    <?php endif;?>
    <!-- Tabla Productos -->
    <div class="overflow-x-auto bg-white rounded-lg shadow p-5">
        <table class="min-w-full table-auto">

                <tr class="bg-gray-100">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Precio</th>
                    <th class="px-4 py-2">Imagen</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>

                <?php foreach($productos as $producto): ?>
                <tr class="border-b">
                    <td class="px-4 py-2"><?= $producto['id_producto'] ?></td>
                    <td class="px-4 py-2"><?= $producto['nombre'] ?></td>
                    <td class="px-4 py-2"><?= $producto['precio'] ?> €</td>
                    <td class="px-4 py-2"><img src="data:image/jpeg;base64,<?= base64_encode($producto['imagen']) ?>" class="w-20 h-20 object-cover"></td>
                    <td class="px-4 py-2 flex gap-2">

                    <form action="../controlador/productocontrolador.php" method="post">
                            <input type="hidden" name="accion" value="eliminar">
                            <input type="hidden" name="id_producto" value="<?= $producto['id_producto'] ?>">

                            <input type="submit" value="Eliminar" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                    </form>

                    <form action="../controlador/productocontrolador.php" method="post">
                            <input type="hidden" name="accion" value="editar">
                            <input type="hidden" name="id_producto" value="<?= $producto['id_producto'] ?>">

                            <input type="submit" value="Editar" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                    </form>
                    </td>
                </tr>
                <?php endforeach; ?>
        </table>
    </div>
</div>
</body>
</html>
