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
    <aside class="w-64 bg-[#3d120d] text-white flex flex-col p-6 shadow-lg hidden md:flex">

        <!-- LOGO -->
        <div class="flex items-center gap-3 mb-10 mt-2">
            <img src="/assets/iconos/logo.svg" alt="Logo" 
                 class="w-12 h-12 transition-transform hover:scale-110 duration-300">

            <h1 class="text-xl font-bold tracking-wide">
                Help<span class="text-orange-400 text-2xl">4</span>África
            </h1>
        </div>

        <!-- MENÚ -->
        <nav class="flex flex-col gap-4 text-lg font-medium">

            <a href="/admin/vista/adminusuarios.php" 
               class="flex items-center gap-3 p-3 rounded-lg transition-all hover:bg-[#5a1d17] <?= basename($_SERVER['PHP_SELF']) == 'adminusuarios.php' ? 'bg-[#5a1d17]' : '' ?>">
               👤 <span>Usuarios</span>
            </a>

            <a href="/admin/vista/adminproductos.php" 
               class="flex items-center gap-3 p-3 rounded-lg transition-all hover:bg-[#5a1d17] <?= basename($_SERVER['PHP_SELF']) == 'adminproductos.php' ? 'bg-[#5a1d17]' : '' ?>">
               🛒 <span>Productos</span>
            </a>

            <a href="/admin/vista/adminpedidos.php" 
               class="flex items-center gap-3 p-3 rounded-lg transition-all hover:bg-[#5a1d17] <?= basename($_SERVER['PHP_SELF']) == 'adminpedidos.php' ? 'bg-[#5a1d17]' : '' ?>">
               📦 <span>Pedidos</span>
            </a>

        </nav>

        <!-- FOOTER -->
        <div class="mt-auto pt-10">
            <a href="/../partials/logout.php" 
               class="block text-center bg-[#e36935e6] hover:bg-[#ce6538e8] transition p-3 rounded-lg font-semibold">
                Cerrar sesión
            </a>
        </div>

    </aside>
</body>
</html>