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

<!-- Carrusel -->
 <div class="relative w-full h-200 overflow-hidden mb-20">

  <!-- Carrusel 1 -->
  <div class="slide absolute inset-0 bg-cover bg-center flex items-center transition-opacity duration-700 opacity-100"
       style="background-image:url('../assets/imagenes/carrusel1.jpg')">

    <!-- Oscuridad Imagen -->
    <div class="absolute inset-0 bg-black/60"></div>
    <!-- Texto -->
    <div class="relative z-10 max-w-xl px-10 text-white ml-10">
      <h2 class="text-4xl font-bold mb-4">
        Millones de niños sufren desnutrición
      </h2>
      <p class="mb-6">
        Necesitan ayuda urgente.
      </p>
      <a href="../pages/producto.php"><div class="btn bg-[#e36935e6]/80 px-6 py-3 font-semibold rounded-full border-0 text-white/70">
        Donar Productos
      </div></a>
    </div>
  </div>

  <!-- Carrusel 2 -->
  <div class="slide absolute inset-0 bg-cover bg-center flex items-center transition-opacity duration-700 opacity-0"
       style="background-image:url('../assets/imagenes/carrusel2.jpg')">
    <!-- Oscuridad Imagen -->
    <div class="absolute inset-0 bg-black/60"></div>
    <!-- Texto -->
    <div class="relative z-10 max-w-xl px-10 text-white ml-10">
      <h2 class="text-4xl font-bold mb-4">
        Tu ayuda salva vidas
      </h2>
      <p class="mb-6">
        Cada donación cuenta.
      </p>
      <a href="../pages/dinero.php">
      <div class="btn bg-[#e36935e6]/80 px-6 py-3 font-semibold rounded-full border-0 text-white/70">
        Donar Dinero
      </div></a>
    </div>
  </div>

</div>
<script>
  let currentSlide = 0;
  const slides = document.querySelectorAll('.slide');

  function showSlide(index) {
    slides.forEach((slide, i) => {
      slide.style.opacity = i === index ? '1' : '0';
    });
  }

  setInterval(() => {
    currentSlide = (currentSlide + 1) % slides.length;
    showSlide(currentSlide);
  }, 5000);
</script>

<!-- ================= QUIÉNES SOMOS ================= -->
<section class="max-w-7xl mx-auto px-4 py-16 space-y-20 mb-10">

  <!-- QUIÉNES SOMOS -->
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
    <div>
      <h2 class="text-4xl font-bold text-[#4A2C2A] mb-10">
        ¿Quiénes somos?
      </h2>
      <p class="text-base text-gray-700 mb-4">
        Somos una organización comprometida con la lucha contra el hambre y la
        desnutrición infantil. Trabajamos cada día para brindar apoyo a comunidades
        vulnerables, garantizando el acceso a alimentos, agua potable y atención
        básica de salud.
      </p>
      <p class="text-base text-gray-700">
        Creemos que ningún niño debería sufrir hambre. Por eso, unimos esfuerzos
        con personas solidarias para generar un impacto real y duradero.
      </p>
    </div>

    <img src="../assets/imagenes/quienes-somos.jpg"
         alt="Quiénes somos"
         class="rounded-xl shadow-lg object-cover w-full h-[320px]">
  </div>

  <!-- QUÉ HACEMOS -->
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
    <img src="../assets/iconos/"
         alt="Qué hacemos"
         class="rounded-xl shadow-lg object-cover w-full h-[320px]">

    <div>
      <h2 class="text-4xl font-bold text-[#4A2C2A] mb-10">
        ¿Qué hacemos?
      </h2>
      <p class="text-base text-gray-700 mb-4">
        Desarrollamos programas de nutrición, seguridad alimentaria y acceso
        a agua segura. Atendemos emergencias humanitarias y acompañamos
        a familias en procesos de recuperación y desarrollo.
      </p>
      <ul class="list-disc list-inside text-gray-700 space-y-2">
        <li>Atención nutricional a niños y niñas</li>
        <li>Distribución de alimentos</li>
        <li>Acceso a agua potable</li>
        <li>Formación y apoyo comunitario</li>
      </ul>
    </div>
  </div>
</section>


<!-- ================= CÓMO DONAR ================= -->
<section class="bg-[#e36935e6]/20 py-20">
  <div class="max-w-7xl mx-auto px-4">

    <!-- Título -->
    <div class="text-center mb-10">
      <h2 class="text-3xl sm:text-4xl font-bold text-[#4A2C2A] mb-4">
        ¿Cómo puedes ayudar?
      </h2>
      <p class="text-gray-700 max-w-md mx-auto">
        Tu apoyo salva vidas. Elige cómo quieres donar.
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-3xl mx-auto">

      <!-- DONAR PRODUCTOS -->
      <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <img src="../assets/iconos/products.svg"
             alt="Donar productos"
             class="w-full h-48 mt-3">

        <div class="p-6 text-center">
          <h3 class="text-xl font-bold mb-2">Donar productos</h3>
          <p class="text-sm text-gray-600 mb-5">
            Alimentos y productos esenciales para familias que lo necesitan.
          </p>
          <a href="../pages/producto.php"
             class="btn w-full py-3 rounded-full bg-[#e36935e6]/80 text-white text-base">
            Donar productos
          </a>
        </div>
      </div>

      <!-- DONAR DINERO -->
      <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <img src="../assets/iconos/donate.svg"
             alt="Donar dinero"
             class="w-full h-48 mt-3">

        <div class="p-6 text-center">
          <h3 class="text-xl font-bold mb-2">Donar dinero</h3>
          <p class="text-sm text-gray-600 mb-5">
            Ayúdanos a responder rápido donde más se necesita.
          </p>
          <a href="../pages/dinero.php"
             class="btn w-full py-3 rounded-full bg-[#e36935e6]/80 text-white text-base">
            Donar dinero
          </a>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- Preguntas Frecuentes -->
<div class="max-w-7xl mx-auto px-3 py-10 mt-10">
    <h1 class="text-4xl font-bold mb-10 mt-12 text-center text-[#4A2C2A]"><?= $textos['faq_title'] ?></h1>

<div class="collapse collapse-arrow bg-base-100 border border-base-300 mb-10">
  <input type="checkbox"/>
  <div class="collapse-title font-semibold">
    ¿Cuál es el destino de mi ayuda?
  </div>
  <div class="collapse-content text-sm">
  Tus donaciones, ya sean productos o dinero, se destinan a programas de nutrición, seguridad alimentaria, acceso a agua potable, salud y desarrollo comunitario. Garantizamos transparencia y publicamos informes periódicos sobre cómo se usan los recursos. 
</div>
</div>

<div class="collapse collapse-arrow bg-base-100 border border-base-300 mb-10">
  <input type="checkbox" />
  <div class="collapse-title font-semibold">
    ¿Cómo puedo donar dinero?
  </div>
  <div class="collapse-content text-sm">
    Puedes donar mediante tarjeta de crédito/débito, transferencia bancaria o plataformas en línea. También ofrecemos donaciones recurrentes. Todas las donaciones reciben un comprobante oficial.

  </div>
</div>

<div class="collapse collapse-arrow bg-base-100 border border-base-300 mb-10">
  <input type="checkbox" />
  <div class="collapse-title font-semibold">
  Quiero donar algo que no está en la lista, ¿puedo hacerlo?
  </div>
  <div class="collapse-content text-sm">
  Contáctanos en la pagina de Contacto y revisaremos si podemos aceptarlo. Siempre valoramos la generosidad y buscamos aprovechar todas las donaciones de manera responsable.

  </div>
</div>
</div>


<?php include_once "../partials/footer.php";?>

</body>
</html>