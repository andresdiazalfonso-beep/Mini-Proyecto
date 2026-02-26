<?php
require_once '..\partials\header.php'; // Incluye el header fijo
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        html, body {
        background: linear-gradient(to bottom right, rgb(255, 238, 204), rgb(252, 168, 0), rgb(120, 79, 0));
        }
        button{
        font-size: 20px;
        }
    </style>
    <title>Dinero</title>
</head>
<body class="min-h-screen pt-30 flex justify-center font-[Poppins]">
<div class="h-100 w-200 bg-white rounded-xl shadow-2xl hover:-translate-y-2 transition-transform px-10 py-10 flex flex-col gap-3">
    <div class="text-center font-bold text-orange-600 text-xl mb-8">
        <div class="hover:cursor-default">Escoja una <span class="text-orange-400">opci&oacute;n</span> a pagar</div>
    </div>
    <div class="flex justify-around mx-25 gap-5">
        <button class="btn border-2 border-gray-800 py-6 flex-grow-1 hover:shadow-xl">5€</button>
        <button class="btn border-2 border-gray-800 py-6 flex-grow-1 hover:shadow-xl">10€</button>
        <button class="btn border-2 border-gray-800 py-6 flex-grow-1 hover:shadow-xl">25€</button>
    </div>
    <div class="flex justify-around mx-25 gap-5">
        <button class="btn border-2 border-gray-800 py-6 flex-grow-1 hover:shadow-xl">50€</button>
        <button class="btn border-2 border-gray-800 py-6 flex-grow-1 hover:shadow-xl">75€</button>
        <button class="btn border-2 border-gray-800 py-6 flex-grow-1 hover:shadow-xl">100€</button>
    </div>
    <div class="flex justify-between mx-25 my-20 gap-5">
        <button class="btn">Confirmar compra</button>
        <a href="index.php" class="hover:cursor-pointer hover:underline text-orange-600 hover:font-bold">Volver al inicio</a>
    </div>
</div>


    
</body>
</html>