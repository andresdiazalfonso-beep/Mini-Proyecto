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
    </style>
    <title>Dinero</title>
</head>
<body class="min-h-screen pt-30 flex justify-center font-[Poppins]">
<div class="h-100 w-200 bg-white rounded-xl shadow-2xl hover:-translate-y-2 transition-transform p-10">
    <button class="btn border-2 border-gray-800">5€</button>
    <button class="btn border-2 border-gray-800">10€</button>
    <button class="btn border-2 border-gray-800">25€</button>
    <button class="btn border-2 border-gray-800">50€</button>
    <button class="btn border-2 border-gray-800">75€</button>
    <button class="btn border-2 border-gray-800">100€</button>
</div>


    
</body>
</html>