<?php
session_start();
// Conexión a la base de datos siguiendo la ruta de tus otros archivos
require_once "../Conexion/conexion.php";
require_once __DIR__."/../partials/header.php"; 
?>

    <main class="flex-grow bg-[#e36935e6]/10 py-16 flex items-center justify-center px-4">
        <div class="bg-white max-w-2xl w-full mx-auto rounded-2xl shadow-xl p-8 md:p-12">
            
            <div class="text-center mb-10">
                <h1 class="text-3xl md:text-4xl font-bold text-[#4A2C2A] mb-4">
                    Haz un donativo
                </h1>
                <p class="text-gray-600">
                    Tu aportación nos ayuda a seguir salvando vidas y llevando recursos básicos a quienes más lo necesitan en África.
                </p>
            </div>

            <form action="confirmar_dinero.php" method="POST" class="space-y-8">
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-4 text-center">
                        Selecciona una cantidad a donar
                    </label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        
                        <label class="cursor-pointer">
                            <input type="radio" name="cantidad" value="5" class="peer sr-only" required>
                            <div class="rounded-xl border-2 border-gray-200 py-4 text-center text-xl font-bold text-gray-600 peer-checked:border-[#e36935] peer-checked:bg-[#e36935] peer-checked:text-white hover:border-[#e36935] transition-all">
                                5€
                            </div>
                        </label>

                        <label class="cursor-pointer">
                            <input type="radio" name="cantidad" value="10" class="peer sr-only">
                            <div class="rounded-xl border-2 border-gray-200 py-4 text-center text-xl font-bold text-gray-600 peer-checked:border-[#e36935] peer-checked:bg-[#e36935] peer-checked:text-white hover:border-[#e36935] transition-all">
                                10€
                            </div>
                        </label>

                        <label class="cursor-pointer">
                            <input type="radio" name="cantidad" value="25" class="peer sr-only">
                            <div class="rounded-xl border-2 border-gray-200 py-4 text-center text-xl font-bold text-gray-600 peer-checked:border-[#e36935] peer-checked:bg-[#e36935] peer-checked:text-white hover:border-[#e36935] transition-all">
                                25€
                            </div>
                        </label>

                        <label class="cursor-pointer">
                            <input type="radio" name="cantidad" value="50" class="peer sr-only">
                            <div class="rounded-xl border-2 border-gray-200 py-4 text-center text-xl font-bold text-gray-600 peer-checked:border-[#e36935] peer-checked:bg-[#e36935] peer-checked:text-white hover:border-[#e36935] transition-all">
                                50€
                            </div>
                        </label>

                        <label class="cursor-pointer">
                            <input type="radio" name="cantidad" value="75" class="peer sr-only">
                            <div class="rounded-xl border-2 border-gray-200 py-4 text-center text-xl font-bold text-gray-600 peer-checked:border-[#e36935] peer-checked:bg-[#e36935] peer-checked:text-white hover:border-[#e36935] transition-all">
                                75€
                            </div>
                        </label>

                        <label class="cursor-pointer">
                            <input type="radio" name="cantidad" value="100" class="peer sr-only">
                            <div class="rounded-xl border-2 border-gray-200 py-4 text-center text-xl font-bold text-gray-600 peer-checked:border-[#e36935] peer-checked:bg-[#e36935] peer-checked:text-white hover:border-[#e36935] transition-all">
                                100€
                            </div>
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        O introduce otra cantidad (€)
                    </label>
                    <input type="number" name="cantidad_libre" min="1" placeholder="Ej: 150" 
                           class="input input-bordered w-full rounded-xl">
                    <p class="text-xs text-gray-500 mt-2">Si rellenas este campo, se ignorará la opción seleccionada arriba.</p>
                </div>

                <div class="pt-4 space-y-4">
                    <button type="submit" class="btn w-full bg-[#e36935] hover:bg-[#d65f2f] border-0 text-white rounded-xl text-lg py-3 h-auto">
                        Confirmar donación
                    </button>
                    
                    <div class="text-center">
                        <a href="index.php" class="text-[#e36935] font-semibold hover:underline text-sm inline-flex items-center gap-1">
                            Volver al inicio
                        </a>
                    </div>
                </div>

            </form>
        </div>
    </main>

    <?php include_once __DIR__.'/../partials/footer.php'; ?>

</body>
</html>