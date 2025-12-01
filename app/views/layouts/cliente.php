<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Cuenta</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="<?= BASE_URL ?>">Mi Tienda</a>
        <a class="btn btn-outline-light" href="<?= BASE_URL ?>cliente/pedidos">
            <i class="bi bi-bag"></i> Mis pedidos
        </a>
    </div>
</nav>

<div class="container py-4">
    <?= $content ?>
</div>

</body>
</html>
