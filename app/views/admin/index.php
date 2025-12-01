<?php ob_start(); ?>

<h2 class="mb-4"><i class="bi bi-speedometer2"></i> Dashboard</h2>

<div class="row">
    <div class="col-md-4">
        <div class="card p-3 shadow-sm text-center">
            <i class="bi bi-basket fs-1 text-primary"></i>
            <h4><?= $totalProductos ?></h4>
            <p class="text-muted">Productos</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-3 shadow-sm text-center">
            <i class="bi bi-receipt fs-1 text-warning"></i>
            <h4><?= $totalPedidos ?></h4>
            <p class="text-muted">Pedidos</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-3 shadow-sm text-center">
            <i class="bi bi-cash fs-1 text-success"></i>
            <h4>$<?= number_format($totalVentas, 2) ?></h4>
            <p class="text-muted">Ventas</p>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require __DIR__ . "/../layouts/admin.php";
?>
