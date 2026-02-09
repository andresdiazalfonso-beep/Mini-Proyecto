<?php
include_once '../language/lenguage.php';
?>

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
<header class="bg-[#faf7f4] shadow-md border-b-2 border-[#e0dad1] fixed top-0 left-0 right-0 z-50">
  <div class="max-w-7xl mx-auto px-3 py-4 flex justify-between items-center lg:pl-20">
    <!-- Logo -->
    <a href="#"> 
    <div class="flex gap-2 justify-center items-center">
        <img src="../assets/iconos/logo.svg" alt="Logo" class="w-10 h-10 transition-transform hover:scale-110 duration-400">
      
        <!-- Texto del logo -->
        <div class="text-xl font-bold font-serif tracking-wide text-[#3d120d]">
        Help<span class="text-orange-500 text-2xl">4</span>África
        </div>
    </div>
    </a>

    <!-- Menú escritorio -->
    <nav class="hidden md:flex md:space-x-5 md:justify-center md:items-center md:font-semibold md:size-lg">
      <a href="../pages/index.php" class="hover:text-orange-500 transition-all duration-300 text-[#3d120d]"><?= $textos['inicio'] ?></a>
      <a href="../pages/producto.php" class="hover:text-orange-500 transition-all duration-300 text-[#3d120d]"><?= $textos['productos'] ?></a>
      <a href="../pages/dinero.php" class="hover:text-orange-500 transition-all duration-300 text-[#3d120d]"><?= $textos['dinero'] ?></a>
      <a href="../pages/contacto.php" class="hover:text-orange-500 transition-all duration-300 text-[#3d120d]"><?= $textos['contacto'] ?></a>
    </nav>

    <!-- Botón Login y Registro (solo escritorio) -->
    <div class="hidden md:flex gap-2">
    <a href="../pages/login.php"><div class="md:btn md:w-full md:rounded-full hover:bg-[#e36935e6] border-[#e36935e6] text-[#e36935e6] hover:text-white md:hover:opacity-90 md:transition-transform md:hover:-translate-y-0.5 md:duration-300 md:p-5 md:text-sm"><?= $textos['login'] ?></div></a>

    <a href="../pages/registro.php"><div class="hover md:btn md:w-full md:rounded-full md:bg-[#e36935e6] md:hover:opacity-90 hover:bg-[#faf7f4] hover:border-[#e36935e6] hover:text-[#e36935e6] md:transition-transform md:hover:-translate-y-0.5 md:duration-300 md:p-5 md:text-white md:text-sm"><?= $textos['registro'] ?></div></a>
    </div>

        <!-- Select idioma -->
      <div class="hidden md:flex md:items-center">
        <form method="post">
            <select name="idioma" onchange="this.form.submit()" class="select select-sm rounded-full">
                <option value="es" <?= $idioma === 'es' ? 'selected' : '' ?>><img src="../assets/iconos/bandera-spain.svg" class="w-4 h-4 mr-2 inline-block">Español</option>
                <option value="en" <?= $idioma === 'en' ? 'selected' : '' ?>><img src="../assets/iconos/bandera-english.svg" class="w-4 h-4 mr-2 inline-block">English</option>
            </select>
        </form>
      </div>




    <!-- Botón menú (solo móvil) -->
    <button id="menuBtn" class="md:hidden text-3xl focus:outline-none" aria-expanded="false">
      <img src="../assets/iconos/boton_menu.svg" alt="Menu" class="w-8 h-8">
    </button>
  
  </div>
    <!-- Menú móvil -->
<div id="mobileMenu" class="hidden md:hidden bg-[#faf7f4] m-1 pb-3 font-semibold size-lg">
  <nav class="flex flex-col w-full px-4 ">
    <a href="../pages/index.php" class="py-3 w-full text-left hover:text-orange-500 transition-all duration-300 text-[#3d120d]"><?= $textos['inicio'] ?></a>
    <a href="../pages/producto.php" class="py-3 w-full text-left hover:text-orange-500 transition-all duration-300 text-[#3d120d]"><?= $textos['productos'] ?></a>
    <a href="../pages/dinero.php" class="py-3 w-full text-left hover:text-orange-500 transition-all duration-300 text-[#3d120d]"><?= $textos['dinero'] ?></a>
    <a href="../pages/contacto.php" class="py-3 w-full text-left hover:text-orange-500 transition-all duration-300 text-[#3d120d]"><?= $textos['contacto'] ?></a>
  </nav>
  <!-- Botón Login y Registro (móvil) -->
  <a href="../pages/login.php"><div class="btn w-full rounded-full hover:opacity-90 transition-transform hover:-translate-y-0.5 duration-300 mb-2 mt-2 hover:bg-[#e36935e6] border-[#e36935e6] text-[#e36935e6] hover:text-white"><?= $textos['login'] ?></div></a>
  <a href="../pages/registro.php"><div class="btn w-full rounded-full bg-[#e36935e6] hover:opacity-90 transition-transform hover:-translate-y-0.5 duration-300"><?= $textos['registro'] ?></div></a>


          <!-- Select idioma -->
      <div class="lg:hidden mt-4 px-2">
  <form method="post" class="w-full">
    <div class="flex items-center gap-2 ">
      <!-- Select -->
      <select name="idioma" onchange="this.form.submit()" class="w-full font-semibold text-[#3d120d] bg-white border border-[#e0dad1] px-4 py-3 shadow-sm appearance-none">
        <option value="es" <?= $idioma === 'es' ? 'selected' : '' ?>>Español</option>
        <option value="en" <?= $idioma === 'en' ? 'selected' : '' ?>>English</option>
      </select>
    </div>
  </form>
</div>

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