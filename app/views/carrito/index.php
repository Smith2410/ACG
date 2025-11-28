<div class="container">

    <h3 class="mb-4">🛒 Carrito de compras</h3>

    <?php if (empty($carrito)): ?>
        <div class="alert alert-info">Tu carrito está vacío.</div>
        <a href="<?= BASE_URL ?>productos/tienda" class="btn btn-primary">Ver productos</a>
        <?php return; ?>
    <?php endif; ?>

    <table class="table align-middle">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cant.</th>
                <th>Subtotal</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <?php $total = 0; ?>

            <?php foreach ($carrito as $item): ?>
                
                <?php $sub = $item['precio'] * $item['cantidad']; ?>
                <?php $total += $sub; ?>

                <tr>
                    <td>
                        <img src="<?= BASE_URL ?>img/productos/<?= $item['imagen'] ?>" width="60" class="rounded">
                        <?= $item['nombre'] ?>
                    </td>
                    <td>$<?= number_format($item['precio'], 2) ?></td>

                    <td>
                        <form action="<?= BASE_URL ?>carrito/actualizar/<?= $item['id'] ?>" method="POST" class="d-flex">
                            <input type="number" name="cantidad" min="1" value="<?= $item['cantidad'] ?>" class="form-control w-50">
                            <button class="btn btn-sm btn-primary ms-2">OK</button>
                        </form>
                    </td>

                    <td>
                        $<?= number_format($sub, 2) ?>
                    </td>

                    <td>
                        <a href="<?= BASE_URL ?>carrito/quitar/<?= $item['id'] ?>" class="btn btn-danger btn-sm">X</a>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="d-flex justify-content-between mt-4">
        <h4>Total: $<?= number_format($total, 2) ?></h4>

        <div>
            <a href="<?= BASE_URL ?>carrito/vaciar" class="btn btn-danger">Vaciar</a>
            <a href="<?= BASE_URL ?>pedido/checkout" class="btn btn-success">Continuar</a>
        </div>
    </div>

</div>
