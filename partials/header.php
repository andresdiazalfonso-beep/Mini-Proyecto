<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
<!-- Header -->
<header class="bg-[#faf7f4] shadow-md border-b-2 border-[#e0dad1]">
  <div class="max-w-7xl mx-auto px-3 py-4 flex justify-between items-center">
    <!-- Logo -->
    <a href="#"> 
    <div class="flex gap-2 justify-center items-center">
        <img src="../assets/logo.svg" alt="Logo" class="w-10 h-10 transition-transform hover:scale-110 duration-400">
      
        <!-- Texto del logo -->
        <div class="text-xl font-bold font-serif tracking-wide text-[#3d120d]">
        Help<span class="text-orange-500 text-2xl">4</span>África
        </div>
    </div>
    </a>

    <!-- Menú escritorio -->
    <nav class="hidden md:flex md:space-x-5 md:justify-center md:items-center md:font-semibold md:size-lg">
      <a href="../pages/index.php" class="hover:text-orange-500 transition-all duration-300 text-[#3d120d]">Inicio</a>
      <a href="../pages/producto.php" class="hover:text-orange-500 transition-all duration-300 text-[#3d120d]">Donar Productos</a>
      <a href="../pages/dinero.php" class="hover:text-orange-500 transition-all duration-300 text-[#3d120d]">Donar Dinero</a>
      <a href="#" class="hover:text-orange-500 transition-all duration-300 text-[#3d120d]">Impacto</a>
      <a href="../pages/contacto.php" class="hover:text-orange-500 transition-all duration-300 text-[#3d120d]">Contacto</a>
    </nav>

    <!-- Botón Login y Registro (solo escritorio) -->
    <div class="hidden md:flex gap-2">
    <a href="../pages/login.php"><div class="md:btn md:w-full md:rounded-full md:bg-[#e36935e6] md:hover:opacity-90 md:transition-transform md:hover:-translate-y-0.5 md:duration-300 md:p-5 md:text-white md:text-sm">Login</div></a>
    <a href="../pages/registro.php"><div class="hover md:btn md:w-full md:rounded-full md:bg-[#e36935e6] md:hover:opacity-90 md:transition-transform md:hover:-translate-y-0.5 md:duration-300 md:p-5 md:text-white md:text-sm">Registro</div></a>
    </div>




    <!-- Botón menú (solo móvil) -->
    <button id="menuBtn" class="md:hidden text-3xl focus:outline-none" aria-expanded="false">
      <img src="../assets/boton_menu.svg" alt="Menu" class="w-8 h-8">
    </button>
  
  </div>
    <!-- Menú móvil -->
<div id="mobileMenu" class="hidden md:hidden bg-white m-1 pb-3 font-semibold size-lg">
  <nav class="flex flex-col w-full px-4 ">
    <a href="../pages/index.php" class="py-3 w-full text-left hover:text-orange-500 transition-all duration-300 text-[#3d120d]">Inicio</a>
    <a href="../pages/productos.php" class="py-3 w-full text-left hover:text-orange-500 transition-all duration-300 text-[#3d120d]">Donar Productos</a>
    <a href="../pages/dinero.php" class="py-3 w-full text-left hover:text-orange-500 transition-all duration-300 text-[#3d120d]">Donar Dinero</a>
    <a href="#" class="py-3 w-full text-left hover:text-orange-500 transition-all duration-300 text-[#3d120d]">Impacto</a>
    <a href="../pages/contacto.php" class="py-3 w-full text-left hover:text-orange-500 transition-all duration-300 text-[#3d120d]">Contacto</a>
  </nav>
  <!-- Botón Login y Registro (móvil) -->
  <a href="../pages/login.php"><div class="btn w-full rounded-full bg-[#e36935e6] hover:opacity-90 transition-transform hover:-translate-y-0.5 duration-300 mb-2 mt-2">Login</div></a>
  <a href="../pages/registro.php"><div class="btn w-full rounded-full bg-[#e36935e6] hover:opacity-90 transition-transform hover:-translate-y-0.5 duration-300">Registrar</div></a>
</div>
</header>


<!-- Script para menú móvil -->
<!-- Sirve para mostrar y ocultar el menú móvil -->
<script>
  const menuBtn = document.getElementById('menuBtn');
  const mobileMenu = document.getElementById('mobileMenu');

 menuBtn.addEventListener('click', () => {
    const isHidden = mobileMenu.classList.toggle('hidden');
    menuBtn.setAttribute('aria-expanded', !isHidden);
  });
    document.addEventListener('click', (e) => {
    if (!mobileMenu.contains(e.target) && !menuBtn.contains(e.target)) {
      mobileMenu.classList.add('hidden');
    }
    });
</script>

</body>
</html>