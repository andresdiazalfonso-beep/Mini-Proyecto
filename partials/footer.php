<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>

<footer class="bg-[#5A4032] text-[#EAD9C9] w-full relative z-[1000] pt-5 mt-20">

  <!-- Contenido principal -->
  <div class="max-w-8xl mx-auto md:px-40 px-10 py-10 grid gap-12 md:grid-cols-4">

    <!-- Logo + descripción -->
    <div>
      <div class="flex items-center gap-3 mb-4">
        <img src="../assets/iconos/logo.svg" alt="Help4África" class="w-10 h-10 transition-transform hover:scale-110 duration-400">
        <div class="text-xl font-bold font-serif tracking-wide text-white/80">
          Help<span class="text-[#e36935e6] text-2xl">4</span>África
        </div>
      </div>

      <p class="text-sm leading-relaxed text-[#D6C2AE]">
        Trabajamos para mejorar la calidad de vida de comunidades vulnerables
        en África mediante ayuda humanitaria y desarrollo sostenible.
      </p>

      <!-- Redes -->
      <div class="flex gap-3 mt-6">
        <a href="#" aria-label="Facebook" class="w-10 h-10 flex items-center justify-center rounded-full bg-[#6C4C3B] hover:bg-[#8B5E3C] transition">
          <img src="../assets/iconos/facebook.svg" alt="" class="w-6 h-6">
        </a>
        <a href="#" aria-label="X" class="w-10 h-10 flex items-center justify-center rounded-full bg-[#6C4C3B] hover:bg-[#8B5E3C] transition">
          <img src="../assets/iconos/X_logo.svg" alt="" class="w-6 h-6">
        </a>
        <a href="#" aria-label="Instagram" class="w-10 h-10 flex items-center justify-center rounded-full bg-[#6C4C3B] hover:bg-[#8B5E3C] transition">
          <img src="../assets/iconos/instagram.svg" alt="" class="w-6 h-6">
        </a>
        <a href="#" aria-label="YouTube" class="w-10 h-10 flex items-center justify-center rounded-full bg-[#6C4C3B] hover:bg-[#8B5E3C] transition">
          <img src="../assets/iconos/youtube.svg" alt="" class="w-6 h-6">
        </a>
      </div>
    </div>

    <!-- Enlaces rápidos -->
    <div class="md:pl-30">
      <h4 class="text-white font-semibold mb-4">Enlaces Rápidos</h4>
      <ul class="space-y-3 text-sm">
        <li><a href="index.php" class="hover:text-orange-500 transition">Inicio</a></li>
        <li><a href="donar-productos.php" class="hover:text-orange-500 transition">Donar Productos</a></li>
        <li><a href="donar-dinero.php" class="hover:text-orange-500 transition">Donar Dinero</a></li>
        <li><a href="impacto.php" class="hover:text-orange-500 transition">Impacto</a></li>
        <li><a href="contacto.php" class="hover:text-orange-500 transition">Contacto</a></li>
      </ul>
    </div>

    
    <!-- Contacto -->
    <div class="md:pl-20">
      <h4 class="text-white font-semibold mb-4 ">Contacto</h4>
      <ul class="space-y-4 text-sm text-[#D6C2AE]">
         <li class="flex gap-3 tracking-wide">
          <img src="../assets/iconos/collaboration.svg" class="h-5 w-5 mt-2">
          <div>
            <p>Andrés Diaz Alfonso</p>
            <p>Abel Hernandez Pereira</p>
          </div>  
          
        </li>
        <li class="flex gap-3">
          <img src="../assets/iconos/phone.svg" class="h-5 w-5">
            +34 600 123 456
        </li>
        <li class="flex gap-3 tracking-wide">
          <img src="../assets/iconos/email.svg" class="h-5 w-5">
            help4africa@gmail.com
        </li>
      </ul>
    </div>


    <!-- Ubicación -->
    <div>
      <h4 class="text-white font-semibold mb-4">Ubicación</h4>

      <ul class="space-y-4 text-sm mb-4 text-[#D6C2AE]">
        <li class="flex gap-3">
          <img src="../assets/iconos/location.svg" class="h-5 w-5">
          <span>Av de la Arboleda, s/n, Av. Arboleda, 21440 Lepe, Huelva, España</span>
        </li>
      </ul>

      <div class="w-full h-40 rounded-lg overflow-hidden border border-[#6C4C3B]">
        <iframe
          class="w-full h-full"
          title="Ubicación Help4África"
          src="https://www.google.com/maps?q=Av de la Arboleda, s/n, Av. Arboleda, 21440 Lepe, Huelva, España&output=embed"
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>
    </div>

  </div>

  <!-- Línea inferior -->
  <div class="border-t border-[#6C4C3B]">
    <div class="w-full py-4 text-center text-sm text-[#CDB8A5] tracking-wider">
      © 2026 Help4África. Todos los derechos reservados.
    </div>
  </div>

</footer>

</body>
</html>
