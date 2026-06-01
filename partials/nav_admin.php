<!-- ../../partials/nav_admin.php -->

<!-- BOTÓN MOBILE -->
<button id="menuBtn" class="md:hidden fixed top-4 right-4 z-50 text-white p-2 rounded-lg shadow" aria-expanded="false">
    <img src="../../assets/iconos/boton_menu.svg" class="w-8 h-8">
</button>

<!-- SIDEBAR -->
<aside id="sidebar"
    class="w-64 bg-[#3d120d] text-white flex flex-col p-6 shadow-lg fixed top-0 left-0 h-screen transform -translate-x-full md:translate-x-0 transition-transform duration-300 z-40">

    <!-- LOGO -->
    <div class="flex items-center gap-3 mb-10 mt-2">
        <img src="/assets/iconos/logo.svg" alt="Logo" class="w-12 h-12">
        <h1 class="text-xl font-bold">
            Help<span class="text-orange-400 text-2xl">4</span>África
        </h1>
    </div>

<!-- MENÚ -->
<?php
$paginaActual = basename($_SERVER['PHP_SELF']); # Con esto detecta la página en la que estás y guarda dicha información
?>

<nav class="flex flex-col gap-4 text-lg font-medium">

    <!-- ESTADÍSTICAS -->
    <a href="/admin/controlador/admin_estadisticascontrolador.php"
       class="flex items-center gap-3 p-3 rounded-lg hover:bg-[#5a1d17] <?= $paginaActual == 'admin_estadisticascontrolador.php' ? 'bg-[#5a1d17]' : '' ?>">
       <div class="bg-[#f19d76] p-2 rounded-xl flex items-center justify-center">
            <img class="w-6 h-6 object-contain shrink-0"
                src="../../assets/iconos/stats-svgrepo-com.svg"
                alt="estadisticas">
        </div>
       Estadísticas
    </a>

    <!-- USUARIOS -->
    <a href="/admin/controlador/admin_usuarioscontrolador.php"
       class="flex items-center gap-3 p-3 rounded-lg hover:bg-[#5a1d17] <?= $paginaActual == 'admin_usuarioscontrolador.php' ? 'bg-[#5a1d17]' : '' ?>">
       <div class="bg-[#f19d76] p-2 rounded-xl flex items-center justify-center">
            <img class="w-6 h-6 object-contain shrink-0"
                src="../../assets/iconos/person-svgrepo-com.svg"
                alt="persona">
        </div>
       Usuarios
    </a>

    <!-- PRODUCTOS -->
    <a href="/admin/vista/adminproductos.php"
       class="flex items-center gap-3 p-3 rounded-lg hover:bg-[#5a1d17] <?= $paginaActual == 'adminproductos.php' ? 'bg-[#5a1d17]' : '' ?>">
       <div class="bg-[#f19d76] p-2 rounded-xl flex items-center justify-center">
            <img class="w-6 h-6 object-contain shrink-0"
                src="../../assets/iconos/cart-shopping-svgrepo-com.svg"
                alt="carro">
        </div>
       Productos
    </a>

    <!-- PEDIDOS -->
    <a href="/admin/vista/adminpedidos.php"
      class="flex items-center gap-3 p-3 rounded-lg hover:bg-[#5a1d17] <?= $paginaActual == 'adminpedidos.php' ? 'bg-[#5a1d17]' : '' ?>"> 
        <div class="bg-[#f19d76] p-2 rounded-xl flex items-center justify-center">
            <img class="w-6 h-6 object-contain shrink-0"
                src="../../assets/iconos/box-svgrepo-com.svg"
                alt="caja">
        </div>
        Pedidos
    </a>

    <!-- DONACIONES -->
    <a href="/admin/controlador/admin_donacionescontrolador.php"
       class="flex items-center gap-3 p-3 rounded-lg hover:bg-[#5a1d17] <?= $paginaActual == 'admin_donacionescontrolador.php' ? 'bg-[#5a1d17]' : '' ?>">
       <div class="bg-[#f19d76] p-2 rounded-xl flex items-center justify-center">
            <img class="w-6 h-6 object-contain shrink-0"
                src="../../assets/iconos/heart-svgrepo-com.svg"
                alt="corazon">
        </div>
       Donaciones
    </a>

    <!-- CONTACTO -->
    <a href="/admin/controlador/admin_contactoscontrolador.php"
       class="flex items-center gap-3 p-3 rounded-lg hover:bg-[#5a1d17] <?= $paginaActual == 'admin_contactoscontrolador.php' ? 'bg-[#5a1d17]' : '' ?>">
       <div class="bg-[#f19d76] p-2 rounded-xl flex items-center justify-center">
            <img class="w-6 h-6 object-contain shrink-0"
                src="../../assets/iconos/mail-alt-3-svgrepo-com.svg"
                alt="carta">
        </div>
       Contacto
    </a>

</nav>

    <!-- FOOTER -->
    <div class="mt-auto pt-10">
        <a href="/partials/logout.php"
           class="block text-center bg-[#e36935e6] hover:bg-[#ce6538e8] p-3 rounded-lg font-semibold">
            Cerrar sesión
        </a>
    </div>

</aside>

<!-- OVERLAY MOBILE -->
<div id="overlay" class="fixed inset-0 bg-black/50 hidden z-30 md:hidden"></div>

<!-- Script menú móvil -->
<script>
const menuBtn = document.getElementById('menuBtn');
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('overlay');

function openMenu() {
  sidebar.classList.remove('-translate-x-full');
  overlay.classList.remove('hidden');
  menuBtn.setAttribute('aria-expanded', 'true');
}

function closeMenu() {
  sidebar.classList.add('-translate-x-full');
  overlay.classList.add('hidden');
  menuBtn.setAttribute('aria-expanded', 'false');
}

menuBtn?.addEventListener('click', () => {
  const isOpen = !sidebar.classList.contains('-translate-x-full');
  isOpen ? closeMenu() : openMenu();
});

overlay?.addEventListener('click', closeMenu);

// cerrar al hacer click en un enlace del menú
document.querySelectorAll('#sidebar a').forEach(link => {
  link.addEventListener('click', () => {
    if (window.innerWidth < 768) closeMenu();
  });
});

</script>