<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? "ACG Store" ?></title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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
            <a class="navbar-brand" href="/menu">ACG Store</a>
            <a href="/carrito" class="btn btn-outline-light ms-auto">🛒 Carrito</a>
        </div>
    </nav>

    <div class="container py-5 fade-in">
        <?php require $viewFile; ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
