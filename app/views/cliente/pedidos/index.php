<div class="container py-4">

    <h2 class="mb-4">
        <i class="bi bi-bag"></i> Mis Pedidos
    </h2>

    <?php if (empty($pedidos)): ?>

        <div class="alert alert-info text-center py-4">
            <i class="bi bi-info-circle"></i> Aún no tienes pedidos.
        </div>

    <?php else: ?>

        <div class="card shadow-sm">
            <div class="card-body">

                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($pedidos as $p): ?>
                        <tr>
                            <td>#<?= $p['id'] ?></td>
                            <td><?= $p['fecha'] ?></td>
                            <td>$<?= number_format($p['total'], 2) ?></td>
                            <td>
                                <?php if ($p['estado'] == 'pendiente'): ?>
                                    <span class="badge bg-warning text-dark">Pendiente</span>
                                <?php elseif ($p['estado'] == 'preparando'): ?>
                                    <span class="badge bg-primary">Preparando</span>
                                <?php elseif ($p['estado'] == 'camino'): ?>
                                    <span class="badge bg-info">En camino</span>
                                <?php elseif ($p['estado'] == 'entregado'): ?>
                                    <span class="badge bg-success">Entregado</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary"><?= $p['estado'] ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end">
                                <a href="<?= BASE_URL ?>clientePedidos/ver/<?= $p['id'] ?>" 
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-receipt"></i> Ver
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>

            </div>
        </div>

    <?php endif; ?>

</div>
