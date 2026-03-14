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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - Donaciones</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
      html, body {
        background: linear-gradient(to bottom right, rgb(255, 180, 89), rgb(252, 168, 0), rgb(120, 79, 0));
        min-height: 100vh;
      }
    </style>
</head>
<body class="font-[Poppins] pt-20">

<div class="container mx-auto px-4 pb-10">
    <div class="flex flex-wrap gap-6 justify-center">
        
        <?php if (empty($productos)): ?>
            <p class="text-white font-bold text-xl">No hay productos disponibles en este momento.</p>
        <?php else: ?>
            <?php foreach($productos as $producto): ?>
                <div class="card bg-base-100 w-80 md:w-96 shadow-sm hover:shadow-2xl transition-all duration-300">
                    <figure class="px-4 pt-4">
                        <div class="w-full h-48 rounded-xl overflow-hidden border border-gray-100">
                            <?php if(!empty($producto['imagen'])): ?>
                                <img src="data:image/jpeg;base64,<?= base64_encode($producto['imagen']) ?>" 
                                     class="w-full h-full object-cover" 
                                     alt="<?= htmlspecialchars($producto['nombre']) ?>">
                            <?php else: ?>
                                <div class="bg-gray-200 w-full h-full flex items-center justify-center text-gray-400">Sin imagen</div>
                            <?php endif; ?>
                        </div>
                    </figure>

                    <div class="card-body">
                        <div class="badge rounded-full bg-orange-100 text-sm font-bold text-orange-600 uppercase">
                            Info
                        </div>
                        
                        <h2 class="card-title text-gray-800">
                            <?= htmlspecialchars($producto['nombre']) ?>
                        </h2>
                        
                        <p class="text-gray-600 text-sm">
                            <?= htmlspecialchars($producto['descripcion']) ?>
                        </p>

                        <div class="card-actions justify-end mt-4">
                            <a href="confirmar_donacion.php?id=<?= $producto['id_producto'] ?>"
                               title="Confirmar donación"
                               class="hover:scale-110 hover:shadow-lg hover:shadow-gray-400 transition-all duration-300 shadow-md badge text-2xl bg-gray-100 px-6 py-5 border-2 border-orange-400 font-mono text-gray-800">
                                <span class="font-bold"><?= number_format($producto['precio'], 2) ?>€</span>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>

    <div class="mt-16 max-w-3xl mx-auto text-center text-gray-50 bg-black/10 p-6 rounded-2xl backdrop-blur-sm">
        <p class="leading-relaxed">
            Todo donativo realizado está 100% destinado a la ayuda y mantenimiento de la vida sudafricana, 
            agradecemos su ayuda tanto el equipo dedicado a esto, como las cientos de personas salvadas diariamente 
            gracias a las donaciones que nos llegan. <br><strong>Gracias de todo corazón.</strong>
        </p>
    </div>
</div>

</body>
</html>