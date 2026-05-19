<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$logueado = isset($_SESSION['usuario']);
$nombreUsuario = $logueado ? htmlspecialchars($_SESSION['usuario']['nombre']) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
            cursor: pointer !important;
            z-index: 20;
        }

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

        .goog-logo-link,
        .goog-te-gadget>span,
        .goog-te-gadget br {
            display: none !important;
        }

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

        .goog-te-menu-frame {
            z-index: 99999999 !important;
        }

        .skiptranslate.goog-te-gadget {
            width: 100% !important;
            height: 100% !important;
        }

        /* Dropdown perfil */
        .perfil-dropdown {
            position: relative;
        }

        .perfil-dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: calc(100% + 8px);
            background: #faf7f4;
            border: 1px solid #e0dad1;
            border-radius: 12px;
            min-width: 200px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.10);
            z-index: 100;
            overflow: hidden;
        }

        .perfil-dropdown:hover .perfil-dropdown-menu,
        .perfil-dropdown.open .perfil-dropdown-menu {
            display: block;
        }

        .perfil-dropdown-menu a,
        .perfil-dropdown-menu button {
            display: flex;
            align-items: center;
            gap: 8px;
            width: 100%;
            padding: 10px 16px;
            font-size: 0.875rem;
            font-weight: 500;
            color: #3d120d;
            text-align: left;
            background: transparent;
            border: none;
            cursor: pointer;
            transition: background 0.2s;
            text-decoration: none;
        }

        .perfil-dropdown-menu a:hover,
        .perfil-dropdown-menu button:hover {
            background: #f0e8e0;
            color: #e36935;
        }

        .perfil-dropdown-menu .perfil-info {
            padding: 12px 16px;
            border-bottom: 1px solid #e0dad1;
            pointer-events: none;
        }

        .perfil-dropdown-menu .perfil-info .nombre {
            font-weight: 700;
            color: #3d120d;
            font-size: 0.9rem;
        }

        .perfil-dropdown-menu .perfil-info .rol {
            font-size: 0.75rem;
            color: #a07060;
            margin-top: 2px;
        }

        .perfil-avatar {
            width: 36px;
            height: 36px;
            border-radius: 9999px;
            background: linear-gradient(135deg, #e36935, #3d120d);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1rem;
            flex-shrink: 0;
        }
    </style>
</head>
<body class="font-[Poppins]">
<!-- Header -->
<header class="bg-[#faf7f4] shadow-md border-b-2 border-[#e0dad1] fixed top-0 left-0 right-0 z-50">
  
  <div class="max-w-7xl mx-auto px-3 py-4 flex justify-between items-center lg:pl-20">
    <!-- Logo -->
    <a href="../pages/index.php"> 
      <div class="flex gap-2 justify-center items-center">
        <img src="../assets/iconos/logo.svg" alt="Logo" class="w-10 h-10 transition-transform hover:scale-110 duration-400">
        <div class="md:hidden lg:block sm:block text-xl font-bold font-serif tracking-wide text-[#3d120d]">
          Help<span class="text-orange-500 text-2xl">4</span>África
        </div>
      </div>
    </a>

    <!-- Menú escritorio -->
    <nav class="hidden md:flex md:space-x-5 md:justify-center md:items-center md:font-semibold md:size-lg">
      <a href="../pages/index.php" class="hover:text-orange-500 transition-all duration-300 text-[#3d120d]">Inicio</a>
      <a href="../controlador/producto_controlador.php" class="hover:text-orange-500 transition-all duration-300 text-[#3d120d]">Donar Productos</a>
      <a href="../pages/dinero.php" class="hover:text-orange-500 transition-all duration-300 text-[#3d120d]">Donar Dinero</a>
      <a href="../pages/contacto.php" class="hover:text-orange-500 transition-all duration-300 text-[#3d120d]">Contacto</a>
    </nav>

    <!-- Zona derecha escritorio -->
    <div class="hidden md:flex gap-2 items-center">

      <?php if ($logueado): ?>
        <!-- Dropdown perfil (escritorio) -->
        <div class="perfil-dropdown" id="perfilDropdown">
          <button class="flex items-center gap-2 px-3 py-2 rounded-full border border-[#e0dad1] bg-white hover:border-[#e36935] transition-all duration-300 focus:outline-none" id="perfilBtn" aria-expanded="false">
            <div class="perfil-avatar"><?= strtoupper(mb_substr($nombreUsuario, 0, 1)) ?></div>
            <span class="text-sm font-semibold text-[#3d120d] max-w-[100px] truncate"><?= $nombreUsuario ?></span>
            <svg class="w-4 h-4 text-[#a07060]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
          </button>

          <div class="perfil-dropdown-menu">
            <div class="perfil-info">
              <div class="nombre"><?= $nombreUsuario ?></div>
              <div class="rol">
                <span class="inline-block bg-orange-100 text-orange-700 text-xs px-2 py-0.5 rounded-full font-semibold">Usuario</span>
              </div>
            </div>
            <a href="../pages/perfil.php">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
              </svg>
              Mi Perfil
            </a>
            <a href="../partials/logout.php">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
              </svg>
              Cerrar Sesión
            </a>
          </div>
        </div>

      <?php else: ?>
        <!-- Botones Login y Registro -->
        <a href="../pages/login.php">
          <div class="md:btn md:w-full md:rounded-full hover:bg-[#e36935e6] border-[#e36935e6] text-[#e36935e6] hover:text-white md:hover:opacity-90 md:transition-transform md:hover:-translate-y-0.5 md:duration-300 md:p-5 md:text-sm">Login</div>
        </a>
        <a href="../pages/registro.php">
          <div class="hover md:btn md:w-full md:rounded-full md:bg-[#e36935e6] md:hover:opacity-90 hover:bg-[#faf7f4] hover:border-[#e36935e6] hover:text-[#e36935e6] md:transition-transform md:hover:-translate-y-0.5 md:duration-300 md:p-5 md:text-white md:text-sm">Registro</div>
        </a>
      <?php endif; ?>

    </div>

    <!-- Select idioma escritorio -->
    <div class="hidden md:flex md:items-center">
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
      <a href="../controlador/producto_controlador.php" class="py-3 w-full text-left hover:text-orange-500 transition-all duration-300 text-[#3d120d]">Donar Productos</a>
      <a href="../pages/dinero.php" class="py-3 w-full text-left hover:text-orange-500 transition-all duration-300 text-[#3d120d]">Donar Dinero</a>
      <a href="../pages/contacto.php" class="py-3 w-full text-left hover:text-orange-500 transition-all duration-300 text-[#3d120d]">Contacto</a>
    </nav>

    <?php if ($logueado): ?>
      <!-- Perfil móvil -->
      <div class="px-4 mt-2 mb-3">
        <div class="flex items-center gap-3 p-3 bg-white rounded-xl border border-[#e0dad1]">
          <div class="perfil-avatar"><?= strtoupper(mb_substr($nombreUsuario, 0, 1)) ?></div>
          <div>
            <div class="font-bold text-[#3d120d] text-sm"><?= $nombreUsuario ?></div>
            <span class="inline-block bg-orange-100 text-orange-700 text-xs px-2 py-0.5 rounded-full font-semibold">Usuario</span>
          </div>
        </div>
      </div>
      <div class="px-4 flex flex-col gap-2">
        <a href="../pages/perfil.php">
          <div class="btn w-full rounded-full border-[#e36935e6] text-[#e36935e6] hover:bg-[#e36935e6] hover:text-white transition-all duration-300">Mi Perfil</div>
        </a>
        <a href="../partials/logout.php">
          <div class="btn w-full rounded-full bg-[#e36935e6] text-white hover:opacity-90 transition-all duration-300">Cerrar Sesión</div>
        </a>
      </div>
    <?php else: ?>
      <!-- Botones Login y Registro móvil -->
      <a href="../pages/login.php"><div class="btn w-full rounded-full hover:opacity-90 transition-transform hover:-translate-y-0.5 duration-300 mb-2 mt-2 hover:bg-[#e36935e6] border-[#e36935e6] text-[#e36935e6] hover:text-white">Login</div></a>
      <a href="../pages/registro.php"><div class="btn w-full rounded-full bg-[#e36935e6] hover:opacity-90 transition-transform hover:-translate-y-0.5 duration-300">Registro</div></a>
    <?php endif; ?>

    <!-- Select idioma móvil -->
    <div class="lg:hidden mt-4 px-2">
      <div class="translate-wrapper ml-4" id="mobile-translate-target">
        <div class="translate-container">
          <div class="google-logo-custom"></div>
          <div id="google_translate_element_mobile"></div>
        </div>
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

// Dropdown perfil (clic para móvil/tablet)
const perfilBtn = document.getElementById('perfilBtn');
const perfilDropdown = document.getElementById('perfilDropdown');

perfilBtn?.addEventListener('click', (e) => {
  e.stopPropagation();
  const open = perfilDropdown.classList.toggle('open');
  perfilBtn.setAttribute('aria-expanded', open);
});

document.addEventListener('click', (e) => {
  if (perfilDropdown && !perfilDropdown.contains(e.target)) {
    perfilDropdown.classList.remove('open');
    perfilBtn?.setAttribute('aria-expanded', 'false');
  }
});
</script>

<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=loadGoogleTranslate&authuser=1"></script>

<script type="text/javascript">
  function loadGoogleTranslate() {
    new google.translate.TranslateElement({
      pageLanguage: 'es',
      autoDisplay: false
    }, 'google_translate_element');
  }
</script>