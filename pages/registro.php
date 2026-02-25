<?php
session_start();

$mensaje = $_SESSION['mensaje'] ?? "";
$errores = $_SESSION['errores'] ?? [];
unset($_SESSION['errores']);
unset($_SESSION['mensaje']);
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="font-[Poppins]">
  <div class="pt-10 ml-15">
  <!-- FLECHA VOLVER AL INICIO -->
    <a href="index.php" class="flex items-center text-[#e36935] font-semibold mb-4 hover:underline">
      <svg xmlns="http://www.w3.org/2000/svg" 
           class="w-5 h-5" 
           fill="none" 
           viewBox="0 0 24 24" 
           stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
              d="M15 19l-7-7 7-7" />
      </svg>
      Volver al inicio
    </a>
  </div>
  
<!--FORMULARIO LOGIN -->
<div class="min-h-screen bg-white flex items-center justify-center px-4">
  <div class="w-full max-w-md rounded-2xl p-8">

    
    <!-- LOGO + TITULO -->
    <div class="text-center mb-5">
      <a href="index.php">
        <img src="../assets/iconos/logo.svg" alt="Logo ONG" class="w-20 mx-auto mb-4 animate-pulse">
      </a>

      <h1 class="text-2xl font-extrabold text-[#4A2C2A]">
        Crear una cuenta
      </h1>
      <p class="text-sm text-gray-500 mt-1">
        Ayuda Contra el Hambre
      </p>
    </div>

    <!-- SEPARADOR -->
    <div class="flex items-center mb-5">
        <hr class="h-0 border-b border-solid grow border-gray-200">
    </div>

    <!-- FORMULARIO -->
    <form action="../controlador/registrocontrolador.php" method="POST" class="space-y-5">

    <!-- Nombre y Apellido -->
      <div>
        <label class="label text-sm font-semibold">Nombre Completo</label>
        <input type="text" name="nombre" required
               class="input input-bordered w-full rounded-xl"
               placeholder="Nombre y Apellido">
          
        <?php if(isset($errores['nombre'])): ?>
          <p class="text-red-500 text-sm mt-1"><?= $errores['nombre'] ?></p>
        <?php endif; ?>
      </div>

    <!-- Correo Electrónico -->
      <div>
        <label class="label text-sm font-semibold">Correo electrónico</label>
        <input type="email" name="email" required
               class="input input-bordered w-full rounded-xl"
               placeholder="correo@ejemplo.com">
          
        <?php if(isset($errores['email'])): ?>
          <p class="text-red-500 text-sm mt-1"><?= $errores['email'] ?></p>
        <?php endif; ?>
      </div>

    <!-- Contraseña -->
      <div>
        <label class="label text-sm font-semibold">Contraseña</label>
        <input type="password" name="password" required
               class="input input-bordered w-full rounded-xl"
               placeholder="Mínimo 6 caracteres">
        
        <?php if(isset($errores['password'])): ?>
          <p class="text-red-500 text-sm mt-1"><?= $errores['password'] ?></p>
        <?php endif; ?>
      </div>

    <!-- Confirmar contraseña -->
      <div>
        <label class="label text-sm font-semibold">Confirmar contraseña</label>
        <input type="password" name="password_confirm" required
               class="input input-bordered w-full rounded-xl"
               placeholder="Repite la contraseña">
               
        <?php if(isset($errores['password_confirm'])): ?>
          <p class="text-red-500 text-sm mt-1"><?= $errores['password_confirm'] ?></p>
        <?php endif; ?>
      </div>

      <div class="flex items-center text-sm">
        <label class="flex items-center gap-2 cursor-pointer">
          <input type="checkbox" required class="checkbox checkbox-sm">
          <span>
            Acepto los
            <a href="#" class="text-[#e36935]">
                términos y condiciones
            </a>
          </span>
        </label>
      </div>

      <button type="submit"
              class="btn w-full bg-[#e36935] hover:bg-[#d65f2f] border-0 text-white rounded-xl text-lg">
        Crear cuenta
      </button>
    </form>

    <!-- LOGIN -->
    <p class="text-center text-sm mt-8 text-gray-600">
      ¿Ya tienes cuenta?
      <a href="login.php" class="text-[#e36935] font-semibold hover:underline">
        Inicia sesión
      </a>
    </p>
  </div>
</div>

</body>
</html>