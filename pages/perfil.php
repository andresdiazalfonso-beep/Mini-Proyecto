<?php
session_start();

// Solo usuarios logueados pueden ver su perfil
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

require_once "../conexion/Conexion.php";
require_once "../modelo/PerfilModelo.php";

$pdo    = Conexion::conectar();
$modelo = new PerfilModelo($pdo);

$idUsuario = (int) $_SESSION['usuario']['id_usuario'];
$usuario   = $modelo->obtenerPorId($idUsuario);

// Por si la sesión tiene datos desactualizados
if (!$usuario) {
    session_destroy();
    header("Location: login.php");
    exit();
}

$errores = $_SESSION['perfil_errores'] ?? [];
$exito   = $_SESSION['perfil_exito']   ?? '';
unset($_SESSION['perfil_errores'], $_SESSION['perfil_exito']);

// Fecha de registro formateada
$fechaRegistro = !empty($usuario['fecha_registro'])
    ? date('d/m/Y', strtotime($usuario['fecha_registro']))
    : 'No disponible';

// Inicial para el avatar
$inicial = strtoupper(mb_substr($usuario['nombre'], 0, 1));
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mi Perfil </title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <style>
    body { font-family: 'Poppins', sans-serif; }

    .perfil-avatar-lg {
      width: 80px;
      height: 80px;
      border-radius: 9999px;
      background: linear-gradient(135deg, #e36935, #3d120d);
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: 700;
      font-size: 2rem;
      flex-shrink: 0;
      box-shadow: 0 4px 16px rgba(227, 105, 53, 0.3);
    }

    .card-perfil {
      background: #faf7f4;
      border: 1px solid #e0dad1;
      border-radius: 16px;
    }

    .dato-label {
      font-size: 0.72rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.06em;
      color: #a07060;
    }

    .dato-valor {
      font-size: 0.95rem;
      font-weight: 500;
      color: #3d120d;
    }

    .input-perfil {
      background: white;
      border: 1px solid #e0dad1;
      border-radius: 10px;
      padding: 10px 14px;
      font-size: 0.9rem;
      color: #3d120d;
      width: 100%;
      transition: border-color 0.2s;
    }

    .input-perfil:focus {
      outline: none;
      border-color: #e36935;
      box-shadow: 0 0 0 3px rgba(227, 105, 53, 0.1);
    }

    .input-perfil.error {
      border-color: #ef4444;
    }

    .btn-guardar {
      background: #e36935;
      color: white;
      border: none;
      border-radius: 10px;
      padding: 10px 28px;
      font-weight: 600;
      font-size: 0.9rem;
      cursor: pointer;
      transition: background 0.2s, transform 0.2s;
    }

    .btn-guardar:hover {
      background: #d65f2f;
      transform: translateY(-1px);
    }

    .divider-perfil {
      border: none;
      border-top: 1px solid #e0dad1;
      margin: 20px 0;
    }
  </style>
</head>
<body class="bg-white">

  <?php include "../partials/header.php"; ?>

  <main class="min-h-screen pt-28 pb-16 px-4 bg-[#fdfaf7]">
    <div class="max-w-2xl mx-auto">

      <!-- Cabecera de página -->
      <div class="mb-8">
        <a href="../pages/index.php" class="flex items-center gap-1 text-[#e36935] font-semibold text-sm mb-4 hover:underline w-fit">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
          </svg>
          Volver al inicio
        </a>
        <h1 class="text-2xl font-bold text-[#3d120d]">Mi Perfil</h1>
        <p class="text-sm text-[#a07060] mt-1">Consulta y edita tus datos personales.</p>
      </div>

      <!-- Mensaje de éxito -->
      <?php if ($exito): ?>
        <div class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 rounded-xl px-4 py-3 mb-6 text-sm font-medium">
          <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
          </svg>
          <?= htmlspecialchars($exito) ?>
        </div>
      <?php endif; ?>

      <!-- Mensaje de error general -->
      <?php if (!empty($errores['general'])): ?>
        <div class="flex items-center gap-3 bg-red-50 border border-red-200 text-red-600 rounded-xl px-4 py-3 mb-6 text-sm font-medium">
          <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
          <?= htmlspecialchars($errores['general']) ?>
        </div>
      <?php endif; ?>

      <!-- Tarjeta resumen del usuario -->
      <div class="card-perfil p-6 mb-6">
        <div class="flex items-center gap-5">
          <div class="perfil-avatar-lg"><?= $inicial ?></div>
          <div class="flex-1 min-w-0">
            <h2 class="text-xl font-bold text-[#3d120d] truncate"><?= htmlspecialchars($usuario['nombre']) ?></h2>
            <p class="text-sm text-[#a07060] truncate"><?= htmlspecialchars($usuario['email']) ?></p>
            <span class="inline-block mt-2 bg-orange-100 text-orange-700 text-xs px-3 py-1 rounded-full font-semibold">
              <?= ucfirst(htmlspecialchars($usuario['rol'] ?? 'usuario')) ?>
            </span>
          </div>
        </div>

        <hr class="divider-perfil">

        <!-- Datos de solo lectura -->
        <div class="grid grid-cols-2 gap-4">
          <div>
            <p class="dato-label mb-1">Miembro desde</p>
            <p class="dato-valor"><?= $fechaRegistro ?></p>
          </div>
          <div>
            <p class="dato-label mb-1">Rol</p>
            <p class="dato-valor">Usuario registrado</p>
          </div>
          <div>
            <p class="dato-label mb-1">Estado</p>
            <p class="dato-valor flex items-center gap-1">
              <span class="inline-block w-2 h-2 rounded-full bg-green-400"></span>
              Activo
            </p>
          </div>
        </div>
      </div>

      <!-- Formulario de edición -->
      <div class="card-perfil p-6">
        <h3 class="text-base font-bold text-[#3d120d] mb-1">Editar datos</h3>
        <p class="text-xs text-[#a07060] mb-5">Puedes cambiar tu nombre y correo. El nombre y el correo deben ser únicos.</p>

        <form action="../controlador/perfilcontrolador.php" method="POST" novalidate>

          <!-- Nombre -->
          <div class="mb-5">
            <label for="nombre" class="dato-label block mb-2">Nombre</label>
            <input
              type="text"
              id="nombre"
              name="nombre"
              value="<?= htmlspecialchars($usuario['nombre']) ?>"
              class="input-perfil <?= isset($errores['nombre']) ? 'error' : '' ?>"
              minlength="4"
              required
              placeholder="Tu nombre"
            >
            <?php if (isset($errores['nombre'])): ?>
              <p class="text-red-500 text-xs mt-1"><?= htmlspecialchars($errores['nombre']) ?></p>
            <?php endif; ?>
          </div>

          <!-- Email -->
          <div class="mb-6">
            <label for="email" class="dato-label block mb-2">Correo electrónico</label>
            <input
              type="email"
              id="email"
              name="email"
              value="<?= htmlspecialchars($usuario['email']) ?>"
              class="input-perfil <?= isset($errores['email']) ? 'error' : '' ?>"
              required
              placeholder="tu@correo.com"
            >
            <?php if (isset($errores['email'])): ?>
              <p class="text-red-500 text-xs mt-1"><?= htmlspecialchars($errores['email']) ?></p>
            <?php endif; ?>
          </div>

          <div class="flex items-center justify-between gap-4 flex-wrap">
            <button type="submit" class="btn-guardar">
              Guardar cambios
            </button>
            <a href="../partials/logout.php" class="text-sm text-[#a07060] hover:text-red-500 font-medium transition-colors duration-200">
              Cerrar sesión
            </a>
          </div>

        </form>
      </div>

    </div>
  </main>

  <?php include "../partials/footer.php"; ?>

</body>
</html>