<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Panel Admin</title>
</head>
<body class="font-[Poppins]">
    <div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-gray-800 text-white flex flex-col p-5 hidden md:flex sm:w-64 bg-gray-800">
        <h2 class="text-2xl font-bold mb-6">Panel Admin</h2>

        <nav class="flex flex-col gap-2">

            <a href="../admin/vista/adminusuarios.php" 
               class="p-2 rounded hover:bg-gray-700 <?= basename($_SERVER['PHP_SELF']) == 'adminusuarios.php' ? 'bg-gray-700' : '' ?>">
               👤 Usuarios
            </a>

            <a href="../admin/vista/adminproductos.php" 
               class="p-2 rounded hover:bg-gray-700 <?= basename($_SERVER['PHP_SELF']) == 'adminproductos.php' ? 'bg-gray-700' : '' ?>">
               🛒 Productos
            </a>

            <a href="../admin/vista/adminpedidos.php" 
               class="p-2 rounded hover:bg-gray-700 <?= basename($_SERVER['PHP_SELF']) == 'adminpedidos.php' ? 'bg-gray-700' : '' ?>">
               📦 Pedidos
            </a>

        </nav>

        <div class="mt-auto pt-5">
            <a href="logout.php" class="block p-2 bg-red-500 text-center rounded hover:bg-red-600">
                Cerrar sesión
            </a>
        </div>
    </aside>

    <!-- CONTENIDO -->
    <main class="flex-1 bg-gray-100 p-6">
</body>
</html>