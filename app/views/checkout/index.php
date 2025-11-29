<div class="container my-4">

    <h3>Confirmar Pedido</h3>
    <p>Revisa tu información antes de finalizar.</p>

    <form action="<?= BASE_URL ?>pedidos/procesar" method="POST">

        <input type="hidden" name="usuario_id" value="<?= $usuario_id ?>">
        <input type="hidden" name="direccion_id" value="<?= $direccion ?>">

        <div class="card p-3 mb-4">
            <h5>Método de pago</h5>

            <select name="metodo_pago" class="form-select" required>
                <option value="efectivo">Efectivo</option>
                <option value="tarjeta">Tarjeta</option>
            </select>
        </div>

        <div class="card p-3">
            <h5>Resumen del pedido</h5>

            <ul class="list-group">
                <?php $total = 0; ?>
                <?php foreach ($carrito as $item): ?>
                    <?php $sub = $item['precio'] * $item['cantidad']; ?>
                    <?php $total += $sub; ?>

                    <li class="list-group-item d-flex justify-content-between">
                        <?= $item['nombre'] ?> x <?= $item['cantidad'] ?>
                        <strong>$<?= number_format($sub,2) ?></strong>
                    </li>
                <?php endforeach; ?>
            </ul>

            <h4 class="mt-3 text-end">Total: 
                <strong class="text-success">$<?= number_format($total, 2) ?></strong>
            </h4>

            <input type="hidden" name="total" value="<?= $total ?>">

            <button type="submit" class="btn btn-success w-100 mt-3">
                Finalizar Pedido
            </button>
        </div>

    </form>

</div>
