<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        /* Ocultar el banner superior de Google */
        .goog-te-banner-frame.skiptranslate,
        .goog-te-banner {
            display: none !important;
        }

        body {
            top: 0px !important;
        }


        .goog-te-gadget {
            font-family: inherit !important;
            font-size: 0 !important;
            display: flex !important;
            align-items: center !important;
            margin: 0 !important;
        }

        .goog-te-gadget .goog-te-combo {
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            border: none !important;
            background: transparent !important;
            opacity: 0 !important;
            /* Totalmente invisible pero clicable */
            cursor: pointer !important;
            z-index: 20;
        }

        /* Contenedor personalizado para el widget */
        .translate-container {
            position: relative;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 6px 12px;
            background: white;
            border-radius: 9999px;
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .translate-container:hover {
            border-color: #2facffff;
            background: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        /* Ocultar elementos de Google que no queremos */
        .goog-logo-link,
        .goog-te-gadget>span,
        .goog-te-gadget br {
            display: none !important;
        }

        /* Contenedor para el logo de Google manual o el que inyecte */
        .google-logo-custom {
            width: 20px;
            height: 20px;
            background: url('https://www.gstatic.com/images/branding/product/1x/translate_24dp.png') no-repeat center;
            background-size: contain;
        }

        #google_translate_element {
            height: 24px;
            display: flex;
            align-items: center;
        }

        /* Asegurar que el desplegable de Google estÃ© por encima de todo */
        .goog-te-menu-frame {
            z-index: 99999999 !important;
        }

        .skiptranslate.goog-te-gadget {
            width: 100% !important;
            height: 100% !important;
        }
    </style>
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
        <div class="md:hidden lg:block sm:block text-xl font-bold font-serif tracking-wide text-[#3d120d]">
          Help<span class="text-orange-500 text-2xl">4</span>&Aacute;frica
        </div>
      </div>
    </a>

    <!-- Menú escritorio -->
    <nav class="hidden md:flex md:space-x-5 md:justify-center md:items-center md:font-semibold md:size-lg">
      <a href="../pages/index.php" class="hover:text-orange-500 transition-all duration-300 text-[#3d120d]">Inicio</a>
      <a href="../pages/producto.php" class="hover:text-orange-500 transition-all duration-300 text-[#3d120d]">Donar Productos</a>
      <a href="../pages/dinero.php" class="hover:text-orange-500 transition-all duration-300 text-[#3d120d]">Donar Dinero</a>
        <a href="../pages/contacto.php" class="hover:text-orange-500 transition-all duration-300 text-[#3d120d]">Contacto</a>
      </nav>

    <!-- Botón Login y Registro -->
    <?php if(!isset($_SESSION['id_usuario'])):?>
    <div class="hidden md:flex gap-2">
      <a href="../pages/login.php">
        <div class="md:btn md:w-full md:rounded-full hover:bg-[#e36935e6] border-[#e36935e6] text-[#e36935e6] hover:text-white md:hover:opacity-90 md:transition-transform md:hover:-translate-y-0.5 md:duration-300 md:p-5 md:text-sm">Login</div>
      </a>
      <a href="../pages/registro.php">
        <div class="hover md:btn md:w-full md:rounded-full md:bg-[#e36935e6] md:hover:opacity-90 hover:bg-[#faf7f4] hover:border-[#e36935e6] hover:text-[#e36935e6] md:transition-transform md:hover:-translate-y-0.5 md:duration-300 md:p-5 md:text-white md:text-sm">Registro</div>
      </a>
    </div>
    <?php else:?>
      <!-- Botón de Cerrar Sesión -->
      <div class="hidden md:flex gap-1">
      <a href="../partials/logout.php">
        <div class="md:btn md:w-full md:rounded-full hover:bg-[#e36935e6] border-[#e36935e6] text-[#e36935e6] hover:text-white md:hover:opacity-90 md:transition-transform md:hover:-translate-y-0.5 md:duration-300 md:p-5 md:text-sm">Cerrar Sesion</div>
      </a>
    </div>
    <?php endif;?>

    <!-- Select idioma escritorio -->
    <div class="hidden md:flex md:items-center">
      <!-- Google Translate Desktop Target -->
        <div class="translate-wrapper ml-4" id="desktop-translate-target">
            <div class="translate-container">
              <div class="google-logo-custom"></div>
                <div id="google_translate_element"></div>
            </div>
        </div>
    </div>

    <!-- Botón menú móvil -->
    <button id="menuBtn" class="md:hidden text-3xl focus:outline-none" aria-expanded="false">
      <img src="../assets/iconos/boton_menu.svg" alt="Menu" class="w-8 h-8">
    </button>
  </div>

  <!-- Menú móvil -->
  <div id="mobileMenu" class="hidden md:hidden bg-[#faf7f4] m-1 pb-3 font-semibold size-lg">
    <nav class="flex flex-col w-full px-4">
      <a href="../pages/index.php" class="py-3 w-full text-left hover:text-orange-500 transition-all duration-300 text-[#3d120d]">Inicio</a>
      <a href="../pages/producto.php" class="py-3 w-full text-left hover:text-orange-500 transition-all duration-300 text-[#3d120d]">Donar Productos</a>
      <a href="../pages/dinero.php" class="py-3 w-full text-left hover:text-orange-500 transition-all duration-300 text-[#3d120d]">Donar Dinero</a>
      <a href="../pages/contacto.php" class="py-3 w-full text-left hover:text-orange-500 transition-all duration-300 text-[#3d120d]">Contacto</a>
    </nav>

    <!-- Botón Login y Registro -->
    <?php if(!isset($_SESSION['id_usuario'])):?>
        <a href="../pages/login.php"><div class="btn w-full rounded-full hover:opacity-90 transition-transform hover:-translate-y-0.5 duration-300 mb-2 mt-2 hover:bg-[#e36935e6] border-[#e36935e6] text-[#e36935e6] hover:text-white">Login</div></a>
        <a href="../pages/registro.php"><div class="btn w-full rounded-full bg-[#e36935e6] hover:opacity-90 transition-transform hover:-translate-y-0.5 duration-300">Registro</div></a>
    <?php else:?>
          <!-- Botón de Cerrar Sesión -->
          <div class="hidden md:flex gap-1">
          <a href="../partials/logout.php">
            <div class="md:btn md:w-full md:rounded-full hover:bg-[#e36935e6] border-[#e36935e6] text-[#e36935e6] hover:text-white md:hover:opacity-90 md:transition-transform md:hover:-translate-y-0.5 md:duration-300 md:p-5 md:text-sm">Cerrar Sesion</div>
          </a>
        </div>
    <?php endif;?>



    <!-- Select idioma móvil -->
    <div class="lg:hidden mt-4 px-2">
      <!-- Google Translate Desktop Target -->
        <div class="translate-wrapper ml-4" id="desktop-translate-target">
            <div class="translate-container">
              <div class="google-logo-custom"></div>
                <div id="google_translate_element"></div>
            </div>
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

<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=loadGoogleTranslate&authuser=1" ></script>

<script type="text/javascript">
      function loadGoogleTranslate() {
        new new google.translate.TranslateElement({
                pageLanguage: 'es',
                autoDisplay: false
            }, 'google_translate_element');
      }
</script>

</body>
</html>