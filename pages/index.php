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

<?php include_once "../partials/header.php";?>

<div class="max-w-7xl mx-auto px-3 py-10">
    <h1 class="text-4xl font-bold mb-6 text-center text-[#3d120d]">Preguntas Frecuentes</h1>

<div class="collapse collapse-arrow bg-base-100 border border-base-300 mb-10">
  <input type="checkbox" />
  <div class="collapse-title font-semibold">
    ¿Cómo puedo crear una cuenta?
  </div>
  <div class="collapse-content text-sm">
    Haz clic en el botón “Registrarse” en la parte superior y sigue el proceso de registro.
  </div>
</div>

<div class="collapse collapse-arrow bg-base-100 border border-base-300 mb-10">
  <input type="checkbox" />
  <div class="collapse-title font-semibold">
    Olvidé mi contraseña, ¿qué hago?
  </div>
  <div class="collapse-content text-sm">
    Haz clic en “¿Olvidaste tu contraseña?” en la página de inicio de sesión y sigue las instrucciones.
  </div>
</div>

<div class="collapse collapse-arrow bg-base-100 border border-base-300 mb-10">
  <input type="checkbox" />
  <div class="collapse-title font-semibold">
    ¿Cómo actualizo mi información personal?
  </div>
  <div class="collapse-content text-sm">
    Ve a “Mi cuenta”, selecciona “Editar perfil” y guarda los cambios.
  </div>
</div>



<?php include_once "../partials/footer.php";?>
</body>
</html>