<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body { background: #f4f6f9; }
        .sidebar {
            width: 240px;
            height: 100vh;
            position: fixed;
            left: 0; top: 0;
            background: #0d6efd;
            padding-top: 20px;
        }
        .sidebar a {
            color: #fff;
            display: block;
            padding: 12px 20px;
            text-decoration: none;
        }
        .sidebar a:hover { background: rgba(255,255,255,0.2); }
        .content { margin-left: 240px; padding: 25px; }
    </style>
</head>

<body>

    <div class="sidebar">
        <h4 class="text-center text-white mb-4"><i class="bi bi-speedometer"></i> Admin</h4>

        <a href="<?= BASE_URL ?>admin/dashboard"><i class="bi bi-grid"></i> Dashboard</a>
        <a href="<?= BASE_URL ?>admin/productos"><i class="bi bi-basket"></i> Productos</a>
        <a href="<?= BASE_URL ?>admin/categorias"><i class="bi bi-tags"></i> Categorías</a>
        <a href="<?= BASE_URL ?>admin/pedidos"><i class="bi bi-receipt"></i> Pedidos</a>
        <a href="<?= BASE_URL ?>admin/repartidores"><i class="bi bi-truck"></i> Repartidores</a>
        <a href="<?= BASE_URL ?>admin/usuarios"><i class="bi bi-truck"></i> Usuarios</a>

        <a href="<?= BASE_URL ?>logout" class="btn btn-outline-danger">Salir</a>
    </div>

    <div class="content">
        <?= $content ?>
    </div>

</body>
</html>
