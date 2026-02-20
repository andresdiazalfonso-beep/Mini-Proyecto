<?php
require_once '..\partials\header.php'; // Incluye el header fijo
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="gap-6 justify-center p-10 bg-gray-100 mt-15">
<div>
  <div class="flex flex-wrap gap-6 justify-center">
    <div class="card bg-base-100 w-96 shadow-sm">
  <figure>
    <img
      class="h-65 object-cover p-4"
      src="https://i.blogs.es/f1e62f/botella-agua/1366_2000.webp"
      alt="Agua" />
  </figure>
  <div class="card-body">
    <h2 class="card-title flex justify-between">
      Agua Mineral
      <div class="badge badge-primary text-lg font-bold"><em>500ml</em></div>
    </h2>
    <p>Una simple botella de agua.<br>Ayuda, aunque no lo parezca.</p>
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
<div class="card bg-base-100 w-96 shadow-sm">
  <figure>
    <img
      class="h-65 w-full"
      src="https://mercadolasaguilas.es/wp-content/uploads/2025/04/Diseno-sin-titulo-9-782x1024.jpg"
      alt="Comida" />
  </figure>
  <div class="card-body">
    <h2 class="card-title flex justify-between">
      Comida variada
      <div class="badge badge-info text-lg text-gray-800 font-bold"><em>0.5kg</em></div>
    </h2>
    <p>Una variedad de alimentos.<br>Conviene tener una dieta equilibrada.<br>Almuerzo y cena para 2.</p>
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
  <figure>
    <img
    class="h-65 w-full"
      src="https://okdiario.com/img/2022/02/19/palmeras-en-espana-655x368.jpg"
      alt="Palmera" />
  </figure>
  <div class="card-body">
    <h2 class="card-title flex justify-between">
      &Aacute;rboles
      <div class="badge badge-success text-lg font-bold"><em>20 semillas</em></div>
    </h2>
    <p>Semillas para clima &aacute;rido<br>Con algo de agua y tiempo, proporcionan sombra y enriquecen la tierra.</p>
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
  <figure>
    <img
    class="h-65 w-full"
      src="https://www.pequerecetas.com/wp-content/uploads/2009/02/pures-para-bebes-de-6-meses.jpg"
      alt="Papillas" />
  </figure>
  <div class="card-body">
    <h2 class="card-title flex justify-between">
      Papillas
      <div class="badge badge-secondary text-lg font-bold"><em>2 botes</em></div>
    </h2>
    <p>Para los ni&ntilde;os.<br>Contienen vitaminas de diferentes frutas, correctas para su desarrollo.</p>
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
  <figure>
    <img
    class="h-65 w-full"
      src="https://jardinesycampos.es/502-large_default/kit-caja-de-herramienta.jpg"
      alt="Herramientas de cultivo" />
  </figure>
  <div class="card-body">
    <h2 class="card-title flex justify-between">
      Equipo
      <div class="badge badge-secondary text-lg font-bold"><em>5 piezas</em></div>
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
  <figure>
    <img
      class="h-65 object-cover"
      src="https://www.agroboca.com/uploads/blog/produccion-artesanal-de-semillas.jpg"
      alt="Semillas" />
  </figure>
  <div class="card-body">
    <h2 class="card-title flex justify-between">
      Semillas de hortaliza
      <div class="badge badge-secondary text-lg font-bold"><em>30 semillas</em></div>
    </h2>
    <p>Algunas semillas para hortalizas de diverso tipo.<br>Pueden soprtar condiciones clim&aacute;ticas adversas.</p>
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

<div class="flex flex-row g-10 text-center">
  <p>Todo donativo realizado est&aacute; 100% destinado a la ayuda y mantenimiento de la vida sudafricana, 
    agradecemos su ayuda tanto el equipo dedicado a esto, como las cientas de personas salvadas diariamente 
    gracias a las donaciones que nos llegan y le podemos hacer llegar.<br>Gracias de todo corazón.
  </p>
</div>
   
</body>
</html>