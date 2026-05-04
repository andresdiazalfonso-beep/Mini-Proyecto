<?php
session_start();
require_once __DIR__ . "/../partials/header.php";

// Si alguien entra aquí directamente sin haber donado, lo mandamos a dinero.php
if (!isset($_SESSION['donacion_cantidad'])) {
    header("Location: dinero.php");
    exit();
}

$cantidad = $_SESSION['donacion_cantidad'];
unset($_SESSION['donacion_cantidad']);
?>

    <main class="flex-grow bg-[#e36935e6]/10 py-16 flex items-center justify-center px-4 mt-18">
        <div class="bg-white max-w-2xl w-full mx-auto rounded-2xl shadow-xl p-8 md:p-12 text-center">

            <div class="mb-8">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>

                <h1 class="text-3xl md:text-4xl font-bold text-[#4A2C2A] mb-4">
                    ¡Gracias por tu donativo!
                </h1>

                <p class="text-gray-600 mb-6">
                    Tu aportación de
                    <span class="font-bold text-[#e36935] text-xl"><?= number_format($cantidad, 2) ?>€</span>
                    ha sido registrada correctamente.<br>
                    Juntos marcamos la diferencia.
                </p>
            </div>

            <div class="space-y-3">
                <a href="dinero.php" class="btn w-full bg-[#e36935] hover:bg-[#d65f2f] border-0 text-white rounded-xl text-lg py-3 h-auto">
                    Hacer otra donación
                </a>
                <a href="index.php" class="block text-[#e36935] font-semibold hover:underline text-sm mt-2">
                    Volver al inicio
                </a>
            </div>

        </div>
    </main>

    <?php include_once __DIR__ . "/../partials/footer.php"; ?>

</body>
</html>