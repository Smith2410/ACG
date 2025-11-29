<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Tarjeta principal -->
            <div class="card shadow-lg border-0 animate__animated animate__fadeIn">
                <div class="card-header bg-success text-white text-center py-4">
                    <h2 class="mb-0">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        ¡Pedido Confirmado!
                    </h2>
                    <p class="mb-0">Gracias por tu compra</p>
                </div>

                <div class="card-body p-4">

                    <!-- Número de pedido -->
                    <div class="text-center mb-4">
                        <h4 class="fw-bold">Pedido #<?= $pedido['id'] ?></h4>
                        <small class="text-muted">Realizado el <?= $pedido['fecha'] ?></small>
                    </div>

                    <!-- Bloque de información -->
                    <div class="border rounded p-3 mb-4 bg-light">
                        <h5 class="fw-bold mb-3"><i class="bi bi-person"></i> Información del Cliente</h5>
                        <p class="mb-1"><strong>Usuario ID:</strong> <?= $pedido['usuario_id'] ?></p>
                        <p class="mb-1"><strong>Dirección ID:</strong> <?= $pedido['direccion_id'] ?></p>
                        <p class="mb-1"><strong>Método de Pago:</strong> <?= ucfirst($pedido['metodo_pago']) ?></p>
                        <p class="mb-1"><strong>Estado:</strong> 
                            <span class="badge bg-primary">
                                <?= ucfirst($pedido['estado']) ?>
                            </span>
                        </p>
                    </div>

                    <!-- Tabla de productos -->
                    <h5 class="fw-bold"><i class="bi bi-bag"></i> Detalles del Pedido</h5>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Producto</th>
                                    <th class="text-center">Cantidad</th>
                                    <th class="text-end">Precio</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($detalle as $item): ?>
                                <tr>
                                    <td><?= $item['producto_id'] ?></td>
                                    <td class="text-center"><?= $item['cantidad'] ?></td>
                                    <td class="text-end">$<?= number_format($item['precio_unitario'], 2) ?></td>
                                    <td class="text-end">$<?= number_format($item['subtotal'], 2) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Total -->
                    <div class="text-end mt-3">
                        <h3 class="fw-bold">Total: 
                            <span class="text-success">$<?= number_format($pedido['total'], 2) ?></span>
                        </h3>
                    </div>

                    <!-- QR opcional -->
                    <div class="text-center mt-4">
                        <img src="https://chart.googleapis.com/chart?cht=qr&chs=200x200&chl=Pedido%20<?= $pedido['id'] ?>" 
                             alt="QR Pedido"
                             class="shadow rounded">
                        <p class="text-muted mt-2">Escanea para ver tu pedido</p>
                    </div>

                </div>

                <div class="card-footer bg-white text-center py-3">
                    <a href="<?= BASE_URL ?>" class="btn btn-outline-primary">
                        <i class="bi bi-house"></i> Volver al inicio
                    </a>

                    <button onclick="window.print()" class="btn btn-success ms-2">
                        <i class="bi bi-printer"></i> Imprimir Ticket
                    </button>
                </div>

            </div>
        </div>
    </div>

</div>