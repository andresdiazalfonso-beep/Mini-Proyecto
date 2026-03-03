<?php
require_once '..\partials\header.php'; // Incluye el header fijo
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
      html, body {
      background: linear-gradient(to bottom right, rgb(255, 180, 89), rgb(252, 168, 0), rgb(120, 79, 0));
      }
    </style>
</head>
<body class="gap-6 justify-center p-10 bg-gray-100 mt-15 font-[Poppins]">
<div class="hover:cursor-default">
  <div class="flex flex-wrap gap-6 justify-center">
    <div class="card bg-base-100 w-96 shadow-sm">
  <div class="card-body">
    <div class="badge rounded-full bg-orange-100 text-sm font-bold text-orange-600"><em>500ml</em></div>
    <h2 class="card-title flex justify-between">
      Agua Mineral
    </h2>
    <p>Una simple botella de agua.<br>Ayuda, aunque no lo parezca.</p>
    <div class="card-actions justify-end">
      <a
      href="#"
      title="Confirmar donación"
      class="hover:scale-105 hover:shadow-lg hover:shadow-gray-700 transition-all duration-300 shadow-md shadow-gray-500 badge text-2xl bg-gray-200 px-5 py-4 border-2 border-orange-300 font-mono">
      <p class="font-bold text-shadow-md">0.50€</p>
      </a>
    </div>
  </div>
</div>
<div class="card bg-base-100 w-96 shadow-sm">
  <div class="card-body">
    <div class="badge rounded-full bg-orange-100 text-sm font-bold text-orange-600"><em>0.5kg</em></div>
    <h2 class="card-title flex justify-between">
      Pack de alimentos
    </h2>
    <p>Una variedad de alimentos.<br>Almuerzo y cena para 2.</p>
    <div class="card-actions justify-end">
      <a
      href="#"
      title="Confirmar donación"
      class="hover:scale-105 hover:shadow-lg hover:shadow-gray-700 transition-all duration-300 shadow-md shadow-gray-500 badge text-2xl bg-gray-200 px-5 py-4 border-2 border-orange-300 font-mono">
      <p class="font-bold text-shadow-lg">5€</p>
      </a>
    </div>
  </div>
</div>
<div class="card bg-base-100 w-96 shadow-sm">
  <div class="card-body">
    <div class="badge rounded-full bg-orange-100 text-sm font-bold text-orange-600"><em>Botiqu&iacute;n</em></div>
    <h2 class="card-title flex justify-between">
      Kit m&eacute;dico
    </h2>
    <p>Para curar heridas y enfermedades leves.<br>Para ni&ntilde;os y adultos.</p>
    <div class="card-actions justify-end">
      <a
      href="#"
      title="Confirmar donación"
      class="hover:scale-105 hover:shadow-lg hover:shadow-gray-700 transition-all duration-300 shadow-md shadow-gray-500 badge text-2xl bg-gray-200 px-5 py-4 border-2 border-orange-300 font-mono">
      <p class="font-bold text-shadow-lg">1€</p>
      </a>
    </div>
  </div>
</div>
<div class="card bg-base-100 w-96 shadow-sm">
  <div class="card-body">
    <div class="badge rounded-full bg-orange-100 text-sm font-bold text-orange-600"><em>2 comidas</em></div>
    <h2 class="card-title flex justify-between">
      Comida infantil
    </h2>
    <p>Para los ni&ntilde;os.<br>Contienen vitaminas de diferente tipo, correctas para su desarrollo.</p>
    <div class="card-actions justify-end">
      <a
      href="#"
      title="Confirmar donación"
      class="hover:scale-105 hover:shadow-lg hover:shadow-gray-700 transition-all duration-300 shadow-md shadow-gray-500 badge text-2xl bg-gray-200 px-5 py-4 border-2 border-orange-300 font-mono">
      <p class="font-bold text-shadow-lg">0.50€</p>
      </a>
    </div>
  </div>
</div>
<div class="flex flex-wrap gap-6 justify-center">
    <div class="card bg-base-100 w-96 shadow-sm">
  <div class="card-body">
    <div class="badge rounded-full bg-orange-100 text-sm font-bold text-orange-600"><em>5 piezas</em></div>
    <h2 class="card-title flex justify-between">
      Equipo
    </h2>
    <p>Sombrero, guantes, palas de 2 tama&ntilde;os y una hazada.</p>
    <div class="card-actions justify-end">
      <a
      href="#"
      title="Confirmar donación"
      class="hover:scale-105 hover:shadow-lg hover:shadow-gray-700 transition-all duration-300 shadow-md shadow-gray-500 badge text-2xl bg-gray-200 px-5 py-4 border-2 border-orange-300 font-mono">
      <p class="font-bold text-shadow-lg">3€</p>
      </a>
    </div>
  </div>
</div>
<div class="flex gap-6 justify-center">
    <div class="card bg-base-100 w-96 shadow-sm">
  <div class="card-body">
    <div class="badge rounded-full bg-orange-100 text-sm font-bold text-orange-600"><em>30 semillas</em></div>
    <h2 class="card-title flex justify-between">
      Semillas
    </h2>
    <p>Algunas semillas de diverso tipo.<br>Pueden soprtar condiciones clim&aacute;ticas adversas.</p>
    <div class="card-actions justify-end">
      <a
      href="#"
      title="Confirmar donación"
      class="hover:scale-105 hover:shadow-lg hover:shadow-gray-700 transition-all duration-300 shadow-md shadow-gray-500 badge text-2xl bg-gray-200 px-5 py-4 border-2 border-orange-300 font-mono">
      <p class="font-bold text-shadow-lg">1€</p>
      </a>
    </div>
  </div>
</div>
</div>
</div>

<div class="flex flex-row g-10 text-center text-gray-50">
  <p>Todo donativo realizado est&aacute; 100% destinado a la ayuda y mantenimiento de la vida sudafricana, 
    agradecemos su ayuda tanto el equipo dedicado a esto, como las cientas de personas salvadas diariamente 
    gracias a las donaciones que nos llegan y les podemos hacer llegar.<br>Gracias de todo coraz&oacute;n.
  </p>
</div>
   
</body>
</html>