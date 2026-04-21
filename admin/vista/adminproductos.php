<?php
session_start();
require_once "../modelo/productosmodelo.php";
require_once "../../Conexion/conexion.php";

$accion = isset($_GET['accion']) ? htmlspecialchars(trim($_GET['accion'])) : "nuevo";
$id_producto = isset($_GET['id_producto']) ? intval($_GET['id_producto']) : "";

$mensaje = $_SESSION['mensaje'] ?? "";
unset($_SESSION['mensaje']);

$productos = obtenerProductos($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Gestión de Productos</title>
</head>
<body class="font-[Poppins]">
<?php require_once "../../partials/nav_admin.php";?>

<div class="flex flex-col gap-6">

<div class="p-5 pt-10 ml-0 md:ml-72 mx-4 md:mx-10">
    <h1 class="text-3xl font-bold mb-6">Productos</h1>

<?php if($accion == "nuevo"):?>
<div class="bg-white p-6 rounded-lg shadow mb- 4border border-gray-100 overflow-x-auto">
        <h2 class="font-semibold text-xl mb-4">Agregar Nuevo Producto</h2>
        <form action="../controlador/productocontrolador.php" method="post" enctype="multipart/form-data" class="space-y-4">
            <input type="hidden" name="accion" value="agregar">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Nombre</span></label>
                    <input type="text" name="nombre" placeholder="Nombre del producto" class="input input-bordered w-full" required>
                </div>
                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Precio (€)</span></label>
                    <input type="number" step="0.01" name="precio" placeholder="0.00" class="input input-bordered w-full" required>
                </div>
            </div>
            
            <div class="form-control">
                <label class="label"><span class="label-text font-medium">Descripción</span></label>
                <input type="text" name="descripcion" placeholder="Breve descripción..." class="input input-bordered w-full" required>
            </div>

            <div class="form-control">
                <label class="label"><span class="label-text font-medium">Imagen</span></label>
                <input type="file" name="imagen" class="file-input file-input-bordered w-full">
            </div>

            <button type="submit" class="btn bg-green-500 text-white hover:bg-green-600 mt-2 w-full md:w-auto px-10">
                Agregar Producto
            </button>
        </form>
    </div>
</div>
<?php endif; ?>


<?php if($accion == "editar"):?>
<?php $editarProducto = obtenerProductoPorId($conexion, $id_producto); ?>

<div class="bg-white p-6 rounded-lg shadow mb-10 border border-gray-100 overflow-x-auto">
        <h2 class="font-semibold text-xl mb-4">Editar Producto</h2>
        <form action="../controlador/productocontrolador.php" method="post" enctype="multipart/form-data" class="space-y-4">
            <input type="hidden" name="id_producto" value="<?= $id_producto; ?>">
            <input type="hidden" name="imagen_actual" value="<?= base64_encode($editarProducto['imagen']); ?>">
            <input type="hidden" name="accion" value="editar">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Nombre</span></label>
                    <input type="text" name="nombre" value="<?= htmlspecialchars($editarProducto['nombre']); ?>" class="input input-bordered w-full" required>
                </div>
                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Precio (€)</span></label>
                    <input type="number" step="0.01" name="precio" value="<?= htmlspecialchars($editarProducto['precio']); ?>" class="input input-bordered w-full" required>
                </div>
            </div>
            
            <div class="form-control">
                <label class="label"><span class="label-text font-medium">Descripción</span></label>
                <input type="text" name="descripcion" value="<?= htmlspecialchars($editarProducto['descripcion']); ?>" class="input input-bordered w-full" required>
            </div>

            <div class="form-control">
                <label class="label"><span class="label-text font-medium">Imagen Actual</span></label>
                <img src="data:image/jpeg;base64,<?= base64_encode($editarProducto['imagen']); ?>" width="120">
            </div>
            
            <div class="form-control">
                <label class="label"><span class="label-text font-medium">Imagen Nueva (Opcional)</span></label>
                <input type="file" name="imagen" class="file-input file-input-bordered w-full">
            </div>

            <div class="flex gap-3 mt-8">
                <button type="submit" class="btn bg-green-500 text-white hover:bg-green-600 px-6">
                    Actualizar Producto
                </button>

                <a href="?accion=nuevo" class="btn btn-outline">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>
    

<div class="p-1 ml-0 md:ml-64 mx-4 md:mx-10 pb-20">
    <?php if(!empty($mensaje)): ?>
        <p class="font-semibold mb-5 text-sm bg-blue-50 p-3 rounded border-l-4 border-blue-500 text-blue-700 ml-10"><?= $mensaje ?></p>
    <?php endif;?>

<!-- En formato movil se mostraran en una columna y en formato movil en dos columnas -->    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:hidden gap-4 ml-5">
        <?php foreach($productos as $producto): ?>
        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col gap-3">
            <div class="flex items-center gap-4">
                <div class="w-20 h-20 rounded-lg overflow-hidden border">
                    <img src="data:image/jpeg;base64,<?= base64_encode($producto['imagen']) ?>" class="w-full h-full object-cover">
                </div>
                <div>
                    <span class="text-xs text-gray-400 font-mono">ID: <?= $producto['id_producto'] ?></span>
                    <h3 class="font-bold text-gray-800"><span class="sm:hidden text-xs text-gray-400 font-mono">Nombre: </span><?= htmlspecialchars($producto['nombre']) ?></h3>
                    <p class="text-lg font-bold text-green-600"><span class="sm:hidden text-sm text-gray-400 font-mono">Precio: </span><?= number_format($producto['precio'], 2) ?> €</p>
                </div>
            </div>
            <div class="flex gap-2">
                <form action="" method="get" class="flex-1">
                    <input type="hidden" name="accion" value="editar">
                    <input type="hidden" name="id_producto" value="<?= $producto['id_producto'] ?>">
                    <button class="btn btn-sm w-full bg-blue-500 text-white text-xs p-4">Editar</button>
                </form>
                <form action="../controlador/productocontrolador.php" method="post" class="flex-1">
                    <input type="hidden" name="accion" value="eliminar">
                    <input type="hidden" name="id_producto" value="<?= $producto['id_producto'] ?>">
                    <button class="btn btn-sm w-full text-white bg-red-500 text-xs p-4" onclick="return confirm('¿Seguro que quieres eliminar este producto?')">Eliminar</button>
                </form>
            </div>
        </div>
        <?php endforeach; ?>
    </div>


<!--En pantallas grandes se mostraran en una tabla --> 
    <div class="hidden lg:block overflow-x-auto bg-white rounded-xl shadow-sm border border-gray-200 md:ml-10">
        <table class="table-auto w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-center">
                    <th class="px-4 py-3 border-b">ID</th>
                    <th class="px-4 py-3 border-b">Nombre</th>
                    <th class="px-4 py-3 border-b">Precio</th>
                    <th class="px-4 py-3 border-b">Imagen</th>
                    <th class="px-4 py-3 border-b">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($productos as $producto): ?>
                <tr class="border-b hover:bg-gray-50 transition-colors text-center">
                    <td class="px-4 py-4"><?= $producto['id_producto'] ?></td>
                    <td class="px-4 py-4 font-medium"><?= htmlspecialchars($producto['nombre']) ?></td>
                    <td class="px-4 py-4 font-semibold"><?= number_format($producto['precio'], 2) ?> €</td>
                    <td class="px-4 py-4">
                        <div class="w-16 h-16 rounded overflow-hidden border border-gray-200 mx-auto">
                            <img src="data:image/jpeg;base64,<?= base64_encode($producto['imagen']) ?>" class="w-full h-full object-cover">
                        </div>
                    </td>
                    <td class="px-4 py-4">
                        <div class="flex gap-2 items-center justify-center">
                            <form action="../controlador/productocontrolador.php" method="post">
                                <input type="hidden" name="accion" value="eliminar">
                                <input type="hidden" name="id_producto" value="<?= $producto['id_producto'] ?>">
                                <button type="submit" class="px-3 py-1 bg-red-500 text-white text-sm font-bold rounded cursor-pointer" onclick="return confirm('¿Seguro que quieres eliminar este producto?')">Eliminar</button>
                            </form>
                            <form action="" method="get">
                                <input type="hidden" name="accion" value="editar">
                                <input type="hidden" name="id_producto" value="<?= $producto['id_producto'] ?>">
                                <button type="submit" class="px-3 py-1 bg-blue-500 text-white text-sm font-bold rounded cursor-pointer">Editar</button>
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