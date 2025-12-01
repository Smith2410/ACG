<?php ob_start(); ?>

<a href="<?= BASE_URL ?>admin/pedidos" class="btn btn-outline-secondary mb-3">
    <i class="bi bi-arrow-left"></i> Volver
</a>

<div class="card shadow">

    <div class="card-header bg-dark text-white">
        <h4 class="m-0"><i class="bi bi-receipt"></i> Pedido #<?= $pedido['id'] ?></h4>
    </div>

    <div class="card-body">

        <p><strong>Cliente:</strong> Usuario <?= $pedido['usuario_id'] ?></p>
        <p><strong>Fecha:</strong> <?= $pedido['fecha'] ?></p>

        <form action="<?= BASE_URL ?>admin/pedidos/estado/<?= $pedido['id'] ?>" method="POST" class="d-flex align-items-center gap-3 mb-3">

            <select name="estado" class="form-select w-auto">
                <option value="pendiente"   <?= $pedido['estado']=='pendiente'?'selected':'' ?>>Pendiente</option>
                <option value="preparando"  <?= $pedido['estado']=='preparando'?'selected':'' ?>>Preparando</option>
                <option value="camino"      <?= $pedido['estado']=='camino'?'selected':'' ?>>En camino</option>
                <option value="entregado"   <?= $pedido['estado']=='entregado'?'selected':'' ?>>Entregado</option>
            </select>

            <button class="btn btn-primary">
                <i class="bi bi-check-circle"></i> Actualizar estado
            </button>
        </form>

        <hr>

        <h5><i class="bi bi-bag-check"></i> Productos</h5>

        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>ID producto</th>
                    <th>Cant.</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                </tr>
            </thead>

            <tbody>
            <?php foreach ($detalle as $d): ?>
                <tr>
                    <td><?= $d['producto_id'] ?></td>
                    <td><?= $d['cantidad'] ?></td>
                    <td>$<?= number_format($d['precio_unitario'], 2) ?></td>
                    <td>$<?= number_format($d['subtotal'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <h3 class="text-end fw-bold">Total: $<?= number_format($pedido['total'], 2) ?></h3>

    </div>
</div>

<?php 
$content = ob_get_clean();
require __DIR__ . "/../../layouts/admin.php";
?>
