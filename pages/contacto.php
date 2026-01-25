<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Contacto</title>
</head>
<body>
<!-- Header -->
<?php include_once "../partials/header.php";?>


<!-- formulario de contacto -->
<section class="bg-[#faf7f4] py-16">
  <div class="max-w-3xl mx-auto px-4">
    
    <h1 class="text-4xl font-serif font-bold text-[#3d120d] text-center mb-4">
      Contáctanos
    </h1>

    <p class="text-center text-gray-700 mb-10">
      ¿Tienes preguntas, quieres colaborar o necesitas más información?
      Escríbenos y te responderemos lo antes posible.
    </p>

    <form action="enviar_contacto.php" method="POST" class="bg-white shadow-lg rounded-2xl p-8 space-y-5">
      
      <input type="text" name="nombre" placeholder="Tu nombre"
        class="input input-bordered w-full" required>

      <input type="email" name="email" placeholder="Tu email"
        class="input input-bordered w-full" required>

      <input type="text" name="asunto" placeholder="Asunto"
        class="input input-bordered w-full">

      <textarea name="mensaje" placeholder="Escribe tu mensaje"
        class="textarea textarea-bordered w-full h-32" required></textarea>

      <button type="submit"
        class="btn w-full rounded-full bg-[#e36935e6] text-white hover:opacity-90">
        Enviar mensaje
      </button>

      <p class="text-xs text-center text-gray-500">
        Al enviar este formulario aceptas nuestra política de privacidad.
      </p>

    </form>

  </div>
</section>



</body>
</html>