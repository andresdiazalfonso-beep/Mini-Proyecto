<!-- ../../partials/nav_admin.php -->

<!-- BOTÓN MOBILE -->
<button id="menuBtn" class="md:hidden fixed top-4 right-4 z-50 bg-[#3d120d] text-white p-2 rounded-lg shadow" aria-expanded="false">
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
    <nav class="flex flex-col gap-4 text-lg font-medium">

        <a href="/admin/vista/adminusuarios.php"
           class="flex items-center gap-3 p-3 rounded-lg hover:bg-[#5a1d17] <?= basename($_SERVER['PHP_SELF']) == 'adminusuarios.php' ? 'bg-[#5a1d17]' : '' ?>">
           👤 Usuarios
        </a>

        <a href="/admin/vista/adminproductos.php"
           class="flex items-center gap-3 p-3 rounded-lg hover:bg-[#5a1d17] <?= basename($_SERVER['PHP_SELF']) == 'adminproductos.php' ? 'bg-[#5a1d17]' : '' ?>">
           🛒 Productos
        </a>

        <a href="/admin/vista/adminpedidos.php"
           class="flex items-center gap-3 p-3 rounded-lg hover:bg-[#5a1d17] <?= basename($_SERVER['PHP_SELF']) == 'adminpedidos.php' ? 'bg-[#5a1d17]' : '' ?>">
           📦 Pedidos
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