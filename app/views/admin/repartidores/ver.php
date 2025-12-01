<div class="container py-4">

    <a href="<?= BASE_URL ?>repartidorPedidos" class="btn btn-outline-secondary mb-3">
        <i class="bi bi-arrow-left"></i> Volver
    </a>

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="m-0"><i class="bi bi-receipt"></i> Pedido #<?= $pedido['id'] ?></h4>
        </div>

        <div class="card-body">

            <p><strong>Fecha:</strong> <?= $pedido['fecha'] ?></p>
            <p><strong>Dirección:</strong> <?= $pedido['direccion_id'] ?></p>
            <p><strong>Total:</strong> $<?= number_format($pedido['total'], 2) ?></p>

            <h5 class="mt-4"><i class="bi bi-basket"></i> Productos</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cant.</th>
                        <th>P. Unit</th>
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

            <hr>

            <h5 class="mb-3"><i class="bi bi-flag"></i> Cambiar estado</h5>

            <form action="<?= BASE_URL ?>repartidorPedidos/estado/<?= $pedido['id'] ?>" method="POST">
                <select name="estado" class="form-select mb-3">
                    <option value="pendiente" <?= $pedido['estado']=='pendiente'?'selected':'' ?>>Pendiente</option>
                    <option value="preparando" <?= $pedido['estado']=='preparando'?'selected':'' ?>>Preparando</option>
                    <option value="camino" <?= $pedido['estado']=='camino'?'selected':'' ?>>En camino</option>
                    <option value="entregado" <?= $pedido['estado']=='entregado'?'selected':'' ?>>Entregado</option>
                </select>

                <button class="btn btn-success">
                    <i class="bi bi-check2-circle"></i>
                    Actualizar Estado
                </button>
            </form>

        </div>
    </div>

</div>
