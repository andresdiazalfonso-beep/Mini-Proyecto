<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$exito   = $_SESSION['contacto_exito']  ?? '';
$errores = $_SESSION['contacto_errores'] ?? [];
$datos   = $_SESSION['contacto_datos']  ?? [];

unset($_SESSION['contacto_exito'], $_SESSION['contacto_errores'], $_SESSION['contacto_datos']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Contacto</title>
</head>
<body class="font-[Poppins]">

<?php include_once "../partials/header.php"; ?>

<section class="bg-white py-30 mt-10">
  <div class="max-w-3xl mx-auto px-4">

    <h1 class="text-4xl font-bold text-[#4A2C2A] text-center mb-4">
      Contáctanos
    </h1>

    <p class="text-center text-gray-700 mb-10">
      ¿Tienes preguntas, quieres colaborar o necesitas más información?
      Escríbenos y te responderemos lo antes posible.
    </p>

    <?php if (!empty($exito)): ?>
    <div class="mb-6 bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded">
        <?= htmlspecialchars($exito) ?>
    </div>
    <?php endif; ?>

    <?php if (!empty($errores['general'])): ?>
    <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded">
        <?= htmlspecialchars($errores['general']) ?>
    </div>
    <?php endif; ?>

    <form action="../controlador/contactocontrolador.php" method="POST"
          class="bg-white shadow-lg rounded-2xl p-8 space-y-5">

      <div>
        <input type="text" name="nombre"
               value="<?= htmlspecialchars($datos['nombre'] ?? '') ?>"
               placeholder="Tu nombre"
               class="input input-bordered w-full <?= !empty($errores['nombre']) ? 'border-red-500' : '' ?>"
               required>
        <?php if (!empty($errores['nombre'])): ?>
          <p class="text-red-500 text-sm mt-1"><?= htmlspecialchars($errores['nombre']) ?></p>
        <?php endif; ?>
      </div>

      <div>
        <input type="email" name="email"
               value="<?= htmlspecialchars($datos['email'] ?? '') ?>"
               placeholder="Tu email"
               class="input input-bordered w-full <?= !empty($errores['email']) ? 'border-red-500' : '' ?>"
               required>
        <?php if (!empty($errores['email'])): ?>
          <p class="text-red-500 text-sm mt-1"><?= htmlspecialchars($errores['email']) ?></p>
        <?php endif; ?>
      </div>

      <input type="text" name="asunto"
             value="<?= htmlspecialchars($datos['asunto'] ?? '') ?>"
             placeholder="Asunto"
             class="input input-bordered w-full">

      <div>
        <textarea name="mensaje" placeholder="Escribe tu mensaje"
                  class="textarea textarea-bordered w-full h-32 <?= !empty($errores['mensaje']) ? 'border-red-500' : '' ?>"
                  required><?= htmlspecialchars($datos['mensaje'] ?? '') ?></textarea>
        <?php if (!empty($errores['mensaje'])): ?>
          <p class="text-red-500 text-sm mt-1"><?= htmlspecialchars($errores['mensaje']) ?></p>
        <?php endif; ?>
      </div>

      <button type="submit"
        class="btn w-full rounded-full bg-[#e36935e6] text-white hover:opacity-95">
        Enviar mensaje
      </button>

    </form>

  </div>
</section>

<?php include_once "../partials/footer.php"; ?>

</body>
</html>