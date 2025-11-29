<div class="container my-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Carrito de Compras</h3>
        <a href="<?= BASE_URL ?>productos/tienda" class="btn btn-outline-primary">
            ← Seguir comprando
        </a>
    </div>

    <?php if (!empty($_SESSION['carrito'])): ?>

    <div class="table-responsive shadow-sm bg-white rounded-3 p-3">

        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th style="width:150px;">Cantidad</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php $total = 0; ?>
                <?php foreach ($_SESSION['carrito'] as $item): ?>
                    <?php 
                        $subtotal = $item['precio'] * $item['cantidad']; 
                        $total += $subtotal;
                    ?>

                    <tr>
                        <td>
                            <img src="<?= BASE_URL ?>img/productos/<?= $item['imagen'] ?>" 
                                 width="70" class="rounded border">
                        </td>

                        <td class="fw-semibold"><?= htmlspecialchars($item['nombre']) ?></td>

                        <td class="fw-bold text-primary">$<?= number_format($item['precio'], 2) ?></td>

                        <td>
                            <form action="<?= BASE_URL ?>carrito/actualizar/<?= $item['id'] ?>" 
                                  method="post" class="d-flex">

                                <input type="number" 
                                       name="cantidad" 
                                       value="<?= $item['cantidad'] ?>" 
                                       min="1"
                                       class="form-control form-control-sm w-50">

                                <button type="submit" 
                                        class="btn btn-sm btn-primary ms-2">
                                    <i class="bi bi-check-circle"></i>
                                </button>
                            </form>
                        </td>

                        <td class="fw-bold text-success">
                            $<?= number_format($subtotal, 2) ?>
                        </td>

                        <td>
                            <a href="<?= BASE_URL ?>carrito/eliminar/<?= $item['id'] ?>" 
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('¿Eliminar este producto?');">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>

        </table>
    </div>

    <!-- TOTAL -->
    <div class="d-flex justify-content-between align-items-center mt-4 p-3 bg-light rounded-3 shadow-sm">
        <h4 class="m-0">Total: 
            <span class="text-success fw-bold">$<?= number_format($total, 2) ?></span>
        </h4>

        <div>
            <a href="<?= BASE_URL ?>carrito/vaciar" 
               class="btn btn-outline-danger"
               onclick="return confirm('¿Vaciar todo el carrito?');">
                Vaciar Carrito
            </a>

            <a href="<?= BASE_URL ?>pedidos/checkout" class="btn btn-success">Finalizar Pedido</a>
        </div>
    </div>

    <?php else: ?>

        <div class="alert alert-info text-center py-4">
            <h5 class="fw-semibold mb-3">Tu carrito está vacío</h5>
            <a href="<?= BASE_URL ?>tienda" class="btn btn-primary">
                Ver productos
            </a>
        </div>

    <?php endif; ?>

</div>
