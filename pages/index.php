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
    <img src="../assets/imagenes/que-hacemos.jpg"
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


<!-- ================= CÓMO DONAR (MOBILE FIRST) ================= -->
<section class="bg-[#fdf4ef] py-12">
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
        <img src="../assets/imagenes/donar-productos.jpg"
             alt="Donar productos"
             class="w-full h-48 object-cover">

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
        <img src="../assets/imagenes/donar-dinero.jpg"
             alt="Donar dinero"
             class="w-full h-48 object-cover">

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
    <h1 class="text-4xl font-bold mb-6 text-center text-[#4A2C2A]">Preguntas Frecuentes</h1>

<div class="collapse collapse-arrow bg-base-100 border border-base-300 mb-10">
  <input type="checkbox"/>
  <div class="collapse-title font-semibold">
    ¿Cuál es el destino de mi ayuda?
  </div>
  <div class="collapse-content text-sm">
    Acción contra el Hambre se compromete a comunicarse con las personas e instituciones que hagan aportaciones finalistas, destinadas a proyectos concretos, sobre el proyecto o actividad apoyada y sus resultados.<br><br>

    Tus donaciones llegarán a proyectos de lucha contra las causas y los efectos del hambre. Salvarán la vida de niños y niñas desnutridos, y garantizarán a las familias acceso a agua segura, alimentos, formación y cuidados básicos de salud. En España trabajamos contra el desempleo y por la inclusión sociolaboral de personas con dificultades de acceso al mercado de trabajo.<br><br>    

    Gracias a tus donaciones a nuestra ONG, llevamos ayuda a más de 26 millones de personas.<br><br>

    Así repartimos los fondos que recibimos según nuestros ejes de actuación: seguridad alimentaria y medios de vida (44% de los fondos), agua, saneamiento & higiene (2% de los fondos), salud (6% de los fondos), nutrición (17% de los fondos), inclusión social (8% de los fondos), reducción de riesgos de desastres (7% de los fondos) e incidencia (2% de los fondos)<br><br>
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
</div>


<?php include_once "../partials/footer.php";?>

</body>
</html>