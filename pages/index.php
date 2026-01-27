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

  <!-- Slide 1 -->
  <div class="slide absolute inset-0 bg-cover bg-center flex items-center transition-opacity duration-700 opacity-100"
       style="background-image:url('/img1.jpg')">
    
    <!-- Overlay oscuro -->
    <div class="absolute inset-0 bg-black/60"></div>

    <!-- Texto -->
    <div class="relative z-10 max-w-xl px-10 text-white">
      <h2 class="text-4xl font-bold mb-4">
        Millones de niños sufren desnutrición
      </h2>
      <p class="mb-6">
        Necesitan ayuda urgente.
      </p>
      <button class="bg-yellow-400 text-black px-6 py-3 font-semibold">
        AYÚDALOS AHORA
      </button>
    </div>
  </div>

  <!-- Slide 2 -->
  <div class="slide absolute inset-0 bg-cover bg-center flex items-center transition-opacity duration-700 opacity-0"
       style="background-image:url('/img2.jpg')">

    <div class="absolute inset-0 bg-black/60"></div>

    <div class="relative z-10 max-w-xl px-10 text-white">
      <h2 class="text-4xl font-bold mb-4">
        Tu ayuda salva vidas
      </h2>
      <p class="mb-6">
        Cada donación cuenta.
      </p>
      <button class="bg-yellow-400 text-black px-6 py-3 font-semibold">
        DONA AHORA
      </button>
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







<!-- Preguntas Frecuentes -->
<div class="max-w-7xl mx-auto px-3 py-10">
    <h1 class="text-4xl font-bold mb-6 text-center text-[#3d120d]">Preguntas Frecuentes</h1>

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



<?php include_once "../partials/footer.php";?>
</body>
</html>