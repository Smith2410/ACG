<div class="container py-4">

    <a href="<?= BASE_URL ?>clientePedidos" class="btn btn-outline-secondary mb-3">
        <i class="bi bi-arrow-left"></i> Volver
    </a>

    <div class="card shadow-lg">
        <div class="card-header bg-dark text-white text-center">
            <h3 class="m-0"><i class="bi bi-receipt"></i> Pedido #<?= $pedido['id'] ?></h3>
        </div>

        <div class="card-body">

            <p><strong>Fecha:</strong> <?= $pedido['fecha'] ?></p>
            <p><strong>Método de Pago:</strong> <?= ucfirst($pedido['metodo_pago']) ?></p>
            <p><strong>Estado:</strong> 
                <span class="badge bg-success"><?= $pedido['estado'] ?></span>
            </p>

            <hr>

            <h5><i class="bi bi-bag"></i> Productos</h5>

            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cant.</th>
                        <th>Precio</th>
                        <th>Subt.</th>
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

            <h3 class="text-end fw-bold mt-3">Total: $<?= number_format($pedido['total'], 2) ?></h3>

            <div class="text-center mt-4">
                <button onclick="window.print()" class="btn btn-success">
                    <i class="bi bi-printer"></i> Imprimir
                </button>
            </div>
        </div>
    </div>
</div>
