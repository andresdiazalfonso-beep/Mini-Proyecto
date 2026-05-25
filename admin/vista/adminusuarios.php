<?php
require_once "../modelo/UsuariosModelo.php";
require_once "../../conexion/Conexion.php";

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header("Location: /pages/login.php");
    exit();
}

$pdo    = Conexion::conectar();
$modelo = new UsuariosModelo($pdo);

$accion     = isset($_GET['accion'])     ? htmlspecialchars(trim($_GET['accion']))  : "lista";
$id_usuario = isset($_GET['id_usuario']) ? intval($_GET['id_usuario'])               : 0;

$mensaje = $_SESSION['mensaje'] ?? "";
unset($_SESSION['mensaje']);

$usuarios = $modelo->obtenerUsuarios();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Gestión de Usuarios</title>
</head>
<body class="font-[Poppins] bg-[#f5f5f5] min-h-screen">
<?php require_once "../../partials/nav_admin.php"; ?>

<div class="flex flex-col gap-6">
<div class="p-5 pt-10 ml-0 md:ml-72 mx-4 md:mx-10">

    <h1 class="text-3xl font-bold mb-6">Usuarios</h1>

    <?php if (!empty($mensaje)): ?>
        <p class="font-semibold mb-5 text-sm bg-blue-50 p-3 rounded border-l-4 border-blue-500 text-blue-700">
            <?= htmlspecialchars($mensaje) ?>
        </p>
    <?php endif; ?>


    <?php if ($accion === "editar" && $id_usuario > 0):
        $editarUsuario = $modelo->obtenerUsuarioPorId($id_usuario);
        if ($editarUsuario): ?>

    <div class="bg-white p-6 rounded-lg shadow mb-8 border border-gray-100">
        <h2 class="font-semibold text-xl mb-4">Editar Usuario</h2>
        <form action="../controlador/admin_usuarioscontrolador.php" method="post" class="space-y-4">
            <input type="hidden" name="accion"     value="editar">
            <input type="hidden" name="id_usuario" value="<?= $editarUsuario['id_usuario'] ?>">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Nombre</span></label>
                    <input type="text" name="nombre"
                           value="<?= htmlspecialchars($editarUsuario['nombre']) ?>"
                           class="input input-bordered w-full" required>
                </div>
                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Email</span></label>
                    <input type="email" name="email"
                           value="<?= htmlspecialchars($editarUsuario['email']) ?>"
                           class="input input-bordered w-full" required>
                </div>
            </div>

            <div class="form-control">
                <label class="label"><span class="label-text font-medium">Rol</span></label>
                <select name="rol" class="select select-bordered w-full max-w-xs">
                    <option value="usuario" <?= $editarUsuario['rol'] === 'usuario' ? 'selected' : '' ?>>Usuario</option>
                    <option value="admin"   <?= $editarUsuario['rol'] === 'admin'   ? 'selected' : '' ?>>Administrador</option>
                </select>
            </div>

            <div class="flex gap-3 mt-4">
                <button type="submit" class="btn bg-green-500 text-white hover:bg-green-600 px-6">
                    Guardar Cambios
                </button>
                <a href="?accion=lista" class="btn btn-outline">Cancelar</a>
            </div>
        </form>
    </div>

    <?php endif; endif; ?>


    <!-- TARJETA RESUMEN -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-400 uppercase font-semibold tracking-wide">Total Usuarios</p>
                    <h2 class="text-4xl font-black mt-2 text-gray-800"><?= count($usuarios) ?></h2>
                </div>
                <div class="bg-orange-100 text-3xl w-16 h-16 rounded-2xl flex items-center justify-center">👥</div>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-400 uppercase font-semibold tracking-wide">Administradores</p>
                    <h2 class="text-4xl font-black mt-2 text-[#e36935e6]">
                        <?= count(array_filter($usuarios, fn($u) => $u['rol'] === 'admin')) ?>
                    </h2>
                </div>
                <div class="bg-red-100 text-3xl w-16 h-16 rounded-2xl flex items-center justify-center">🔑</div>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-400 uppercase font-semibold tracking-wide">Usuarios Estándar</p>
                    <h2 class="text-4xl font-black mt-2 text-green-600">
                        <?= count(array_filter($usuarios, fn($u) => $u['rol'] === 'usuario')) ?>
                    </h2>
                </div>
                <div class="bg-green-100 text-3xl w-16 h-16 rounded-2xl flex items-center justify-center">👤</div>
            </div>
        </div>
    </div>


    <!-- TARJETAS MÓVIL -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:hidden gap-4">
        <?php foreach ($usuarios as $usuario): ?>
        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col gap-3">
            <div>
                <span class="text-xs text-gray-400 font-mono">ID: <?= $usuario['id_usuario'] ?></span>
                <h3 class="font-bold text-gray-800"><?= htmlspecialchars($usuario['nombre']) ?></h3>
                <p class="text-sm text-gray-500"><?= htmlspecialchars($usuario['email']) ?></p>
                <span class="inline-block mt-1 px-2 py-0.5 rounded-full text-xs font-semibold
                    <?= $usuario['rol'] === 'admin' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' ?>">
                    <?= ucfirst($usuario['rol']) ?>
                </span>
            </div>
            <div class="flex gap-2">
                <form action="" method="get" class="flex-1">
                    <input type="hidden" name="accion"     value="editar">
                    <input type="hidden" name="id_usuario" value="<?= $usuario['id_usuario'] ?>">
                    <button class="btn btn-sm w-full bg-blue-500 text-white text-xs p-4">Editar</button>
                </form>
                <form action="../controlador/admin_usuarioscontrolador.php" method="post" class="flex-1">
                    <input type="hidden" name="accion"     value="eliminar">
                    <input type="hidden" name="id_usuario" value="<?= $usuario['id_usuario'] ?>">
                    <button class="btn btn-sm w-full bg-red-500 text-white text-xs p-4"
                            onclick="return confirm('¿Seguro que quieres eliminar este usuario?')">
                        Eliminar
                    </button>
                </form>
            </div>
        </div>
        <?php endforeach; ?>
    </div>


    <!-- TABLA ESCRITORIO -->
    <div class="hidden lg:block overflow-x-auto bg-white rounded-xl shadow-sm border border-gray-200 pb-20">
        <table class="table-auto w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-center">
                    <th class="px-4 py-3 border-b">ID</th>
                    <th class="px-4 py-3 border-b">Nombre</th>
                    <th class="px-4 py-3 border-b">Email</th>
                    <th class="px-4 py-3 border-b">Rol</th>
                    <th class="px-4 py-3 border-b">Fecha Registro</th>
                    <th class="px-4 py-3 border-b">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                <tr class="border-b hover:bg-gray-50 transition-colors text-center">
                    <td class="px-4 py-4"><?= $usuario['id_usuario'] ?></td>
                    <td class="px-4 py-4 font-medium"><?= htmlspecialchars($usuario['nombre']) ?></td>
                    <td class="px-4 py-4 text-gray-500"><?= htmlspecialchars($usuario['email']) ?></td>
                    <td class="px-4 py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            <?= $usuario['rol'] === 'admin' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' ?>">
                            <?= ucfirst($usuario['rol']) ?>
                        </span>
                    </td>
                    <td class="px-4 py-4 text-gray-400 text-sm">
                        <?= isset($usuario['fecha_registro']) ? htmlspecialchars($usuario['fecha_registro']) : '—' ?>
                    </td>
                    <td class="px-4 py-4">
                        <div class="flex gap-2 items-center justify-center">
                            <form action="" method="get">
                                <input type="hidden" name="accion"     value="editar">
                                <input type="hidden" name="id_usuario" value="<?= $usuario['id_usuario'] ?>">
                                <button type="submit" class="px-3 py-1 bg-blue-500 text-white text-sm font-bold rounded cursor-pointer">
                                    Editar
                                </button>
                            </form>
                            <form action="../controlador/admin_usuarioscontrolador.php" method="post">
                                <input type="hidden" name="accion"     value="eliminar">
                                <input type="hidden" name="id_usuario" value="<?= $usuario['id_usuario'] ?>">
                                <button type="submit"
                                        class="px-3 py-1 bg-red-500 text-white text-sm font-bold rounded cursor-pointer"
                                        onclick="return confirm('¿Seguro que quieres eliminar este usuario?')">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>
</div>
</body>
</html>
