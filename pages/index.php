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
 <div class="relative w-full h-200 overflow-hidden">

  <!-- Carrusel 1 -->
  <div class="slide absolute inset-0 bg-cover bg-center flex items-center transition-opacity duration-700 opacity-100"
       style="background-image:url('../assets/imagenes/carrusel1.jpg')">

    <!-- Oscuridad Imagen -->
    <div class="absolute inset-0 bg-black/60"></div>

    <!-- Texto -->
    <div class="relative z-10 max-w-xl px-10 text-white">
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
    <div class="relative z-10 max-w-xl px-10 text-white">
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


<section class="py-20 bg-base-100">
  <div class="max-w-7xl mx-auto px-6">

    <h2 class="text-4xl font-extrabold text-center text-[#4A2C2A] mb-6">
      Cómo puedes ayudar hoy
    </h2>

    <p class="text-center text-gray-600 max-w-2xl mx-auto mb-14">
      Tu ayuda puede marcar la diferencia de muchas formas.
      Elige cómo quieres contribuir y cambia una vida hoy.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

      <!-- Donar dinero -->
      <div class="card bg-base-100 shadow-xl hover:shadow-2xl hover:-translate-y-2 transition-all">
        <div class="card-body text-center">
          <div class="text-6xl mb-4">💳</div>
          <h3 class="text-2xl font-bold mb-2">Donar dinero</h3>
          <p class="text-gray-600 mb-6">
            Tu donación permite brindar alimentos, agua potable
            y atención médica inmediata.
          </p>
          <a href="../pages/dinero.php"
             class="btn bg-[#e36935] text-white border-0 w-full">
            Donar ahora
          </a>
        </div>
      </div>

      <!-- Donar productos -->
      <div class="card bg-base-100 shadow-xl hover:shadow-2xl hover:-translate-y-2 transition-all">
        <div class="card-body text-center">
          <div class="text-6xl mb-4">📦</div>
          <h3 class="text-2xl font-bold mb-2">Donar productos</h3>
          <p class="text-gray-600 mb-6">
            Dona alimentos y artículos esenciales
            para las familias más vulnerables.
          </p>
          <a href="../pages/producto.php"
             class="btn btn-outline w-full">
            Donar productos
          </a>
        </div>
      </div>

      <!-- Voluntariado -->
      <div class="card bg-base-100 shadow-xl hover:shadow-2xl hover:-translate-y-2 transition-all">
        <div class="card-body text-center">
          <div class="text-6xl mb-4">🤝</div>
          <h3 class="text-2xl font-bold mb-2">Voluntariado</h3>
          <p class="text-gray-600 mb-6">
            Ofrece tu tiempo y habilidades
            para ayudar directamente en el terreno.
          </p>
          <a href="../pages/voluntariado.php"
             class="btn btn-outline w-full">
            Quiero ayudar
          </a>
        </div>
      </div>

    </div>
  </div>
</section>




<section class="py-16">
  <div class="max-w-6xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">

    <div>
      <p class="text-5xl font-bold text-[#e36935]">26M+</p>
      <p class="text-gray-600 mt-2">Vidas impactadas</p>
    </div>

    <div>
      <p class="text-5xl font-bold text-[#e36935]">50+</p>
      <p class="text-gray-600 mt-2">Países</p>
    </div>

    <div>
      <p class="text-5xl font-bold text-[#e36935]">90%</p>
      <p class="text-gray-600 mt-2">Ayuda directa</p>
    </div>

    <div>
      <p class="text-5xl font-bold text-[#e36935]">1M+</p>
      <p class="text-gray-600 mt-2">Niños atendidos</p>
    </div>

  </div>
</section>



<section class="bg-base-200 py-20">
  <div class="max-w-7xl mx-auto px-6">

    <h2 class="text-4xl font-bold text-center mb-14">
      Tú decides cómo ayudar
    </h2>

    <div class="grid md:grid-cols-3 gap-10">

      <div class="card bg-base-100 shadow-xl hover:scale-105 transition">
        <div class="card-body text-center">
          <div class="text-6xl mb-4">💳</div>
          <h3 class="text-2xl font-bold">Donación económica</h3>
          <p class="text-gray-600">
            Alimentos, agua y atención médica inmediata.
          </p>
          <a href="../pages/dinero.php" class="btn bg-[#e36935] text-white border-0">
            Donar ahora
          </a>
        </div>
      </div>

      <div class="card bg-base-100 shadow-xl hover:scale-105 transition">
        <div class="card-body text-center">
          <div class="text-6xl mb-4">📦</div>
          <h3 class="text-2xl font-bold">Productos</h3>
          <p class="text-gray-600">
            Alimentos y artículos esenciales para familias.
          </p>
          <a href="../pages/producto.php" class="btn btn-outline">
            Donar productos
          </a>
        </div>
      </div>

      <div class="card bg-base-100 shadow-xl hover:scale-105 transition">
        <div class="card-body text-center">
          <div class="text-6xl mb-4">🙌</div>
          <h3 class="text-2xl font-bold">Voluntariado</h3>
          <p class="text-gray-600">
            Dona tu tiempo y cambia vidas.
          </p>
          <a href="../pages/voluntariado.php" class="btn btn-outline">
            Quiero ayudar
          </a>
        </div>
      </div>

    </div>
  </div>
</section>




<section class="bg-[#e36935] py-20 text-white text-center">
  <h2 class="text-4xl font-extrabold mb-6">
    Hoy puedes salvar una vida
  </h2>
  <p class="text-lg mb-8">
    No lo dejes para mañana.
  </p>
  <a href="../pages/dinero.php"
     class="btn bg-white text-[#e36935] border-0 px-10">
    Donar ahora
  </a>
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