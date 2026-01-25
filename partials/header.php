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
<header class="bg-[#faf7f4] shadow-md">
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
    <nav class="hidden md:flex md:space-x-6 md:justify-center md:items-center md:font-semibold md:size-lg">
      <a href="#" class="hover:text-orange-500 transition-all duration-300 text-[#3d120d]">Inicio</a>
      <a href="#" class="hover:text-orange-500 transition-all duration-300 text-[#3d120d]">Cómo Ayudar</a>
      <a href="#" class="hover:text-orange-500 transition-all duration-300 text-[#3d120d]">Productos</a>
      <a href="#" class="hover:text-orange-500 transition-all duration-300 text-[#3d120d]">Impacto</a>
      <a href="#" class="hover:text-orange-500 transition-all duration-300 text-[#3d120d]">Contacto</a>
    </nav>

    <!-- Botón Donar Ahora (solo escritorio) -->
    <div class="hidden md:block">
    <a href="#"><div class="md:btn md:w-full md:rounded-full md:bg-[#e36935e6] md:hover:opacity-90 md:transition-transform md:hover:-translate-y-0.5 md:duration-300 md:p-5 md:text-white md:text-sm">Donar Ahora</div></a>
    </div>




    <!-- Botón menú (solo móvil) -->
    <button id="menuBtn" class="md:hidden text-3xl focus:outline-none" aria-expanded="false">
      <img src="../assets/boton_menu.svg" alt="Menu" class="w-8 h-8">
    </button>
  
  </div>
    <!-- Menú móvil -->
<div id="mobileMenu" class="hidden md:hidden bg-white m-1 pb-3 font-semibold size-lg">
  <nav class="flex flex-col w-full px-4 ">
    <a href="#" class="py-3 w-full text-left hover:text-orange-500 transition-all duration-300 text-[#3d120d]">Inicio</a>
    <a href="#" class="py-3 w-full text-left hover:text-orange-500 transition-all duration-300 text-[#3d120d]">Cómo Ayudar</a>
    <a href="#" class="py-3 w-full text-left hover:text-orange-500 transition-all duration-300 text-[#3d120d]">Productos</a>
    <a href="#" class="py-3 w-full text-left hover:text-orange-500 transition-all duration-300 text-[#3d120d]">Impacto</a>
    <a href="#" class="py-3 w-full text-left hover:text-orange-500 transition-all duration-300 text-[#3d120d]">Contacto</a>
  </nav>
  <!-- Botón Donar Ahora (móvil) -->
  <a href="#"><div class="btn w-full rounded-full bg-[#e36935e6] hover:opacity-90 transition-transform hover:-translate-y-0.5 duration-300">Donar Ahora</div></a>
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