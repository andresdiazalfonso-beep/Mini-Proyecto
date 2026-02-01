<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar sesión</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-base-200">

<?php include_once "../partials/header.php"; ?>

<section class="min-h-screen flex items-center justify-center px-4">
  <div class="card w-full max-w-md bg-base-100 shadow-xl">
    <div class="card-body">

      <h2 class="text-3xl font-extrabold text-center mb-6 text-[#4A2C2A]">
        Iniciar sesión
      </h2>

      <form action="../controllers/loginController.php" method="POST" class="space-y-4">

        <div>
          <label class="label">Correo electrónico</label>
          <input type="email" name="email" required
                 class="input input-bordered w-full"
                 placeholder="correo@ejemplo.com">
        </div>

        <div>
          <label class="label">Contraseña</label>
          <input type="password" name="password" required
                 class="input input-bordered w-full"
                 placeholder="••••••••">
        </div>

        <div class="flex justify-between items-center text-sm">
          <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" class="checkbox checkbox-sm">
            Recuérdame
          </label>
          <a href="#" class="text-[#e36935] hover:underline">
            ¿Olvidaste tu contraseña?
          </a>
        </div>

        <button type="submit"
                class="btn bg-[#e36935] text-white border-0 w-full mt-4">
          Entrar
        </button>
      </form>

      <p class="text-center text-sm mt-6">
        ¿No tienes cuenta?
        <a href="registro.php" class="text-[#e36935] font-semibold hover:underline">
          Regístrate
        </a>
      </p>

    </div>
  </div>
</section>

<?php include_once "../partials/footer.php"; ?>

</body>
</html>
