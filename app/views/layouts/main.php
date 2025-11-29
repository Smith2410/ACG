<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? "ACG Store" ?></title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <!-- ANIMACIONES -->
    <style>
        .zoom-hover {
            transition: transform .3s ease, box-shadow .3s ease;
        }
        .zoom-hover:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0,0,0,.15);
        }

        .fade-in {
            animation: fadeIn .6s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0);   }
        }
    </style>
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="<?= BASE_URL ?>menu">ACG Store</a>
            <a href="<?= BASE_URL ?>carrito" class="btn btn-outline-light ms-auto">🛒 Carrito</a>
        </div>
    </nav>

    <div class="container py-5 fade-in">
        <?php require $viewFile; ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
