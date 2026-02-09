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

<!-- ================= CARRUSEL ================= -->
<div class="relative w-full h-200 overflow-hidden mb-20">

    <!-- Slide 1 -->
    <div class="slide absolute inset-0 bg-cover bg-center flex items-center transition-opacity opacity-100"
         style="background-image:url('../assets/imagenes/carrusel1.jpg')">
        <div class="absolute inset-0 bg-black/60"></div>
        <div class="relative z-10 max-w-xl px-10 text-white ml-10">
            <h2 class="text-4xl font-bold mb-4"><?= $textos['carrusel1_titulo'] ?></h2>
            <p class="mb-6"><?= $textos['carrusel1_texto'] ?></p>
            <a href="../pages/producto.php">
                <div class="btn bg-[#e36935e6]/80 px-6 py-3 font-semibold rounded-full border-0 text-white/70 transition-transform hover:-translate-y-0.5 duration-300">
                    <?= $textos['carrusel1_boton'] ?>
                </div>
            </a>
        </div>
    </div>

    <!-- Slide 2 -->
    <div class="slide absolute inset-0 bg-cover bg-center flex items-center transition-opacity duration-700 opacity-0"
         style="background-image:url('../assets/imagenes/carrusel2.jpg')">
        <div class="absolute inset-0 bg-black/60"></div>
        <div class="relative z-10 max-w-xl px-10 text-white ml-10">
            <h2 class="text-4xl font-bold mb-4"><?= $textos['carrusel2_titulo'] ?></h2>
            <p class="mb-6"><?= $textos['carrusel2_texto'] ?></p>
            <a href="../pages/dinero.php">
                <div class="btn bg-[#e36935e6]/80 px-6 py-3 font-semibold rounded-full border-0 text-white/70 transition-transform hover:-translate-y-0.5 duration-300">
                    <?= $textos['carrusel2_boton'] ?>
                </div>
            </a>
        </div>
    </div>

</div>
<script>
let currentSlide = 0;
const slides = document.querySelectorAll('.slide');
function showSlide(index) {
    slides.forEach((slide,i)=>slide.style.opacity = i===index?'1':'0');
}
setInterval(()=>{ currentSlide=(currentSlide+1)%slides.length; showSlide(currentSlide); },5000);
</script>



<!-- ================= QUIÉNES SOMOS ================= -->
<section class="max-w-7xl mx-auto px-4 py-16 space-y-20 mb-10">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
        <div>
            <h2 class="text-4xl font-bold text-[#4A2C2A] mb-10"><?= $textos['quienes_somos_titulo'] ?></h2>
            <p class="text-base text-gray-700 mb-4"><?= $textos['quienes_somos_texto1'] ?></p>
            <p class="text-base text-gray-700"><?= $textos['quienes_somos_texto2'] ?></p>
        </div>
        <img src="../assets/imagenes/quienes-somos.jpg" alt="Quiénes somos" class="rounded-xl shadow-lg object-cover w-full h-[320px]">
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
        <img src="../assets/imagenes/que-hacemos.jpg" alt="Qué hacemos" class="rounded-xl shadow-lg object-cover w-full h-[320px]">
        <div>
            <h2 class="text-4xl font-bold text-[#4A2C2A] mb-10"><?= $textos['que_hacemos_titulo'] ?></h2>
            <p class="text-base text-gray-700 mb-4"><?= $textos['que_hacemos_texto'] ?></p>
            <ul class="list-disc list-inside text-gray-700 space-y-2">
                <li><?= $textos['que_hacemos_lista1'] ?></li>
                <li><?= $textos['que_hacemos_lista2'] ?></li>
                <li><?= $textos['que_hacemos_lista3'] ?></li>
                <li><?= $textos['que_hacemos_lista4'] ?></li>
            </ul>
        </div>
    </div>
</section>


<!-- ================= CÓMO DONAR ================= -->
<section class="bg-[#e36935e6]/10 py-10">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl sm:text-4xl font-bold text-[#4A2C2A] mb-4"><?= $textos['como_ayudar_titulo'] ?></h2>
            <p class="text-gray-700 max-w-md mx-auto"><?= $textos['como_ayudar_texto'] ?></p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-26 max-w-3xl mx-auto my-10">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <img src="../assets/iconos/productosdonar.svg" alt="Donar productos" class="w-full h-48 mt-3">
                <div class="p-6 text-center">
                    <h3 class="text-xl font-bold mb-2"><?= $textos['donar_productos_titulo'] ?></h3>
                    <p class="text-sm text-gray-600 mb-5"><?= $textos['donar_productos_texto'] ?></p>
                    <a href="../pages/producto.php" class="btn w-full py-3 rounded-full bg-[#e36935e6]/80 text-white text-base transition-transform hover:-translate-y-0.5 duration-300"><?= $textos['productos'] ?></a>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <img src="../assets/iconos/money.svg" alt="Donar dinero" class="w-full h-48 mt-3">
                <div class="p-6 text-center">
                    <h3 class="text-xl font-bold mb-2"><?= $textos['donar_dinero_titulo'] ?></h3>
                    <p class="text-sm text-gray-600 mb-5"><?= $textos['donar_dinero_texto'] ?></p>
                    <a href="../pages/dinero.php" class="btn w-full py-3 rounded-full bg-[#e36935e6]/80 text-white text-base transition-transform hover:-translate-y-0.5 duration-300"><?= $textos['dinero'] ?></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================= PREGUNTAS FRECUENTES ================= -->
<div class="max-w-7xl mx-auto px-3 py-10 mt-10">
    <h1 class="text-4xl font-bold mb-10 mt-12 text-center text-[#4A2C2A]"><?= $textos['faq_title'] ?></h1>

    <div class="collapse collapse-arrow bg-base-100 border border-base-300 mb-10">
        <input type="checkbox"/>
        <div class="collapse-title font-semibold"><?= $textos['faq_destino'] ?></div>
        <div class="collapse-content text-sm"><?= $textos['faq_destino_texto'] ?></div>
    </div>

    <div class="collapse collapse-arrow bg-base-100 border border-base-300 mb-10">
        <input type="checkbox"/>
        <div class="collapse-title font-semibold"><?= $textos['faq_dinero'] ?></div>
        <div class="collapse-content text-sm"><?= $textos['faq_dinero_texto'] ?></div>
    </div>

    <div class="collapse collapse-arrow bg-base-100 border border-base-300 mb-10">
        <input type="checkbox"/>
        <div class="collapse-title font-semibold"><?= $textos['faq_producto_extra'] ?></div>
        <div class="collapse-content text-sm"><?= $textos['faq_producto_extra_texto'] ?></div>
    </div>
</div>


<?php include_once "../partials/footer.php";?>

</body>
</html>