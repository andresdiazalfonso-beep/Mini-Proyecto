<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar Sesión</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="min-h-screen bg-white flex items-center justify-center px-4">

  <div class="w-full max-w-md rounded-2xl p-8">

    <!-- LOGO + TITULO -->
    <div class="text-center mb-5">
      <a href="index.php">
      <img src="../assets/iconos/logo.svg" alt="Logo ONG" class="w-20 mx-auto mb-4 animate-pulse">
      </a>

      <h1 class="text-2xl font-extrabold text-[#4A2C2A]">
        Iniciar Sesión
      </h1>
      <p class="text-sm text-gray-500 mt-1">
        Todo por una buena causa
      </p>
    </div>

    <!-- SEPARADOR -->
    <div class="flex items-center mb-5">
        <hr class="h-0 border-b border-solid grow border-gray-200">
    </div>

    <!-- FORMULARIO -->
    <form action="../controlador/logincontrolador.php" method="POST" class="space-y-5">

      <div>
        <label class="label text-sm font-semibold">Correo electrónico</label>
        <input type="email" name="email" required class="input input-bordered w-full rounded-xl">
      </div>

      <div>
        <label class="label text-sm font-semibold">Contraseña</label>
        <input type="password" name="password" required class="input input-bordered w-full rounded-xl">
      </div>

      <div class="flex items-center text-sm">
        <label class="flex items-center gap-2 cursor-pointer">
          <input type="checkbox" class="checkbox checkbox-sm">
          <span>
            Recordar
          </span>
        </label>
      </div>

      <button type="submit"
              class="btn w-full bg-[#e36935] hover:bg-[#d65f2f] border-0 text-white rounded-xl text-lg">
        Iniciar Sesión
      </button>
    </form>

    <!-- LOGIN -->
    <p class="text-center text-sm mt-8 text-gray-600">
      ¿No tienes cuenta?
      <a href="registro.php" class="text-[#e36935] font-semibold hover:underline">
        Regístrate aquí
      </a>
    </p>

  </div>

</body>
</html>
