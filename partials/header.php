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
    <title>Inicio</title>
</head>
<body>
<!-- Header -->
<header class="bg-[#faf7f4] shadow-md border-b-2 border-[#e0dad1] fixed top-0 left-0 right-0 z-50">
  
  <!-- Cambié a 'fixed' y añadí z-50 para que quede sobre el contenido -->

  <div class="max-w-7xl mx-auto px-3 py-4 flex justify-between items-center lg:pl-20">
    <!-- Logo -->
    <a href="../pages/index.php"> 
      <div class="flex gap-2 justify-center items-center">
        <img src="../assets/iconos/logo.svg" alt="Logo" class="w-10 h-10 transition-transform hover:scale-110 duration-400">
        <div class="text-xl font-bold font-serif tracking-wide text-[#3d120d]">
          Help<span class="text-orange-500 text-2xl">4</span>&Aacute;frica
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

    <!-- Botón Login y Registro -->
    <div class="hidden md:flex gap-2">
      <a href="../pages/login.php">
        <div class="md:btn md:w-full md:rounded-full hover:bg-[#e36935e6] border-[#e36935e6] text-[#e36935e6] hover:text-white md:hover:opacity-90 md:transition-transform md:hover:-translate-y-0.5 md:duration-300 md:p-5 md:text-sm"><?= $textos['login'] ?></div>
      </a>
      <a href="../pages/registro.php">
        <div class="hover md:btn md:w-full md:rounded-full md:bg-[#e36935e6] md:hover:opacity-90 hover:bg-[#faf7f4] hover:border-[#e36935e6] hover:text-[#e36935e6] md:transition-transform md:hover:-translate-y-0.5 md:duration-300 md:p-5 md:text-white md:text-sm"><?= $textos['registro'] ?></div>
      </a>
    </div>

    <label class="swap swap-rotate">
    <!-- this hidden checkbox controls the state -->
    <input type="checkbox"/>

    <!-- sun icon -->
    <svg
      class="swap-off h-7 w-7 fill-current"
      xmlns="http://www.w3.org/2000/svg"
      viewBox="0 0 24 24">
      <path
        d="M5.64,17l-.71.71a1,1,0,0,0,0,1.41,1,1,0,0,0,1.41,0l.71-.71A1,1,0,0,0,5.64,17ZM5,12a1,1,0,0,0-1-1H3a1,1,0,0,0,0,2H4A1,1,0,0,0,5,12Zm7-7a1,1,0,0,0,1-1V3a1,1,0,0,0-2,0V4A1,1,0,0,0,12,5ZM5.64,7.05a1,1,0,0,0,.7.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.41l-.71-.71A1,1,0,0,0,4.93,6.34Zm12,.29a1,1,0,0,0,.7-.29l.71-.71a1,1,0,1,0-1.41-1.41L17,5.64a1,1,0,0,0,0,1.41A1,1,0,0,0,17.66,7.34ZM21,11H20a1,1,0,0,0,0,2h1a1,1,0,0,0,0-2Zm-9,8a1,1,0,0,0-1,1v1a1,1,0,0,0,2,0V20A1,1,0,0,0,12,19ZM18.36,17A1,1,0,0,0,17,18.36l.71.71a1,1,0,0,0,1.41,0,1,1,0,0,0,0-1.41ZM12,6.5A5.5,5.5,0,1,0,17.5,12,5.51,5.51,0,0,0,12,6.5Zm0,9A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Z" />
    </svg>

    <!-- moon icon -->
    <svg
      class="swap-on h-7 w-7 fill-current"
      xmlns="http://www.w3.org/2000/svg"
      viewBox="0 0 24 24">
      <path
        d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z" />
    </svg>
  </label>

    <!-- Select idioma escritorio -->
    <div class="hidden md:flex md:items-center">
      <form method="post">
        <select name="idioma" onchange="this.form.submit()" class="select select-sm rounded-full">
          <option value="es" <?= $idioma === 'es' ? 'selected' : '' ?>><img src="../assets/iconos/bandera-spain.svg" class="w-5 h-5">Español</option>
          <option value="en" <?= $idioma === 'en' ? 'selected' : '' ?>><img src="../assets/iconos/bandera-english.svg" class="w-5 h-5">English</option>
        </select>
      </form>
    </div>

    <!-- Botón menú móvil -->
    <button id="menuBtn" class="md:hidden text-3xl focus:outline-none" aria-expanded="false">
      <img src="../assets/iconos/boton_menu.svg" alt="Menu" class="w-8 h-8">
    </button>
  </div>

  <!-- Menú móvil -->
  <div id="mobileMenu" class="hidden md:hidden bg-[#faf7f4] m-1 pb-3 font-semibold size-lg">
    <nav class="flex flex-col w-full px-4">
      <a href="../pages/index.php" class="py-3 w-full text-left hover:text-orange-500 transition-all duration-300 text-[#3d120d]"><?= $textos['inicio'] ?></a>
      <a href="../pages/producto.php" class="py-3 w-full text-left hover:text-orange-500 transition-all duration-300 text-[#3d120d]"><?= $textos['productos'] ?></a>
      <a href="../pages/dinero.php" class="py-3 w-full text-left hover:text-orange-500 transition-all duration-300 text-[#3d120d]"><?= $textos['dinero'] ?></a>
      <a href="../pages/contacto.php" class="py-3 w-full text-left hover:text-orange-500 transition-all duration-300 text-[#3d120d]"><?= $textos['contacto'] ?></a>
    </nav>
    <a href="../pages/login.php"><div class="btn w-full rounded-full hover:opacity-90 transition-transform hover:-translate-y-0.5 duration-300 mb-2 mt-2 hover:bg-[#e36935e6] border-[#e36935e6] text-[#e36935e6] hover:text-white"><?= $textos['login'] ?></div></a>
    <a href="../pages/registro.php"><div class="btn w-full rounded-full bg-[#e36935e6] hover:opacity-90 transition-transform hover:-translate-y-0.5 duration-300"><?= $textos['registro'] ?></div></a>

    <!-- Select idioma móvil -->
    <div class="lg:hidden mt-4 px-2">
      <form method="post" class="w-full">
        <select name="idioma" onchange="this.form.submit()" class="w-full font-semibold text-[#3d120d] bg-white border border-[#e0dad1] px-4 py-3 shadow-sm appearance-none">
          <option value="es" <?= $idioma === 'es' ? 'selected' : '' ?>>Español</option>
          <option value="en" <?= $idioma === 'en' ? 'selected' : '' ?>>English</option>
        </select>
      </form>
    </div>
  </div>
</header>

<!-- Script menú móvil -->
<script>
const menuBtn = document.getElementById('menuBtn');
const mobileMenu = document.getElementById('mobileMenu');

menuBtn?.addEventListener('click', () => {
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