<?php $title = "Menú"; ?>

<h1 class="mb-4 text-center fw-bold">Nuestro Menú</h1>

<div class="row g-4">
<?php foreach ($productos as $p): ?>
    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <div class="card h-100 shadow-sm zoom-hover">

            <img src="<?= BASE_URL ?>img/productos/<?= $p['imagen'] ?>"
                 class="card-img-top"
                 style="height:180px; object-fit:cover;">

            <div class="card-body d-flex flex-column">
                <h5 class="card-title fw-bold"><?= $p['nombre'] ?></h5>
                <p class="card-text text-muted small"><?= $p['descripcion'] ?></p>

                <h4 class="mt-auto fw-bold text-success">
                    $<?= number_format($p['precio'], 2) ?>
                </h4>

                <a href="<?= BASE_URL ?>carrito/agregar/<?= $p['id'] ?>" class="btn btn-success">
                    Agregar al carrito
                </a>


            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>
