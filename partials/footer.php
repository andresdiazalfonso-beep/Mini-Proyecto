<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
  <footer class="bg-[#5A4032] text-[#EAD9C9] w-full">

  <!-- Contenido principal -->
  <div class="max-w-7xl mx-auto px-6 py-16 grid gap-12 md:grid-cols-3">

    <!-- Logo + descripción -->
    <div>
      <div class="flex items-center gap-3 mb-4">
        <img src="../assets/iconos/logo.svg" alt="Help4África" class="w-10 h-10 transition-transform hover:scale-110 duration-400">

        <!-- Texto del logo -->
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
        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-[#6C4C3B] hover:bg-[#8B5E3C] transition">
          <img src="../assets/iconos/facebook.svg" alt="Facebook" class="w-6 h-6">
        </a>
        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-[#6C4C3B] hover:bg-[#8B5E3C] transition">
          <img src="../assets/iconos/X_logo.svg" alt="Twitter" class="w-6 h-6">
        </a>
        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-[#6C4C3B] hover:bg-[#8B5E3C] transition">
          <img src="../assets/iconos/instagram.svg" alt="Instagram" class="w-6 h-6">
        </a>
        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-[#6C4C3B] hover:bg-[#8B5E3C] transition">
          <img src="../assets/iconos/youtube.svg" alt="YouTube" class="w-6 h-6">
        </a>
      </div>
    </div>

    <!-- Navegación -->
    <div class="md:pl-30">
      <h4 class="text-white font-semibold mb-4">Enlaces Rápidos</h4>
      <ul class="space-y-3 text-sm">
        <li><a href="#" class="hover:text-white transition">Inicio</a></li>
        <li><a href="#" class="hover:text-white transition">Donar Productos</a></li>
        <li><a href="#" class="hover:text-white transition">Donar Dinero</a></li>
        <li><a href="#" class="hover:text-white transition">Impacto</a></li>
        <li><a href="#" class="hover:text-white transition">Contacto</a></li>
      </ul>
    </div>

<!-- Contacto -->
<div>
  <h4 class="text-white font-semibold mb-4">Contacto</h4>

  <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 items-start">

    <!-- Datos -->
    <ul class="space-y-4 text-sm">
      <li class="flex gap-3">
        <span>📍</span>
        <span>Madrid, España</span>
      </li>
      <li class="flex gap-3 text-[#D6C2AE]">
        <img src="../assets/iconos/phone.svg" class="h-5 w-5">
        <span>+34 600 123 456</span>
      </li>
      <li class="flex gap-3 text-[#D6C2AE]">
        <img src="../assets/iconos/email.svg" class="h-5 w-5">
        <span>help4africa@gmail.com</span>
      </li>
    </ul>

    <!-- Mapa -->
    <div class="w-full h-40 rounded-lg overflow-hidden border border-[#6C4C3B]">
      <iframe
        class="w-full h-full"
        src="https://www.google.com/maps?q=Av de la Arboleda, s/n, Av. Arboleda, 21440 Lepe, Huelva, España&output=embed"
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>
  </div>
</div>
</div>

  <!-- Línea inferior -->
  <div class="border-t border-[#6C4C3B]">
    <div class="w-full py-4 text-center justify-center text-sm text-[#CDB8A5] tracking-wider">
      <span>© 2026 Help4África. Todos los derechos reservados.</span> 
    </div>
  </div>

</footer>


</body>
</html>