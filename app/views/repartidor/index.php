<div class="container py-4">

    <h2><i class="bi bi-truck"></i> Pedidos Asignados</h2>
    <p class="text-muted">Repartidor: #1 (demo)</p>

    <?php if (empty($pedidos)): ?>

        <div class="alert alert-info mt-3">
            <i class="bi bi-info-circle"></i> No tienes pedidos asignados.
        </div>

    <?php else: ?>

        <div class="card shadow-sm mt-3">
            <div class="card-body">

                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Dirección</th>
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
                            <td><?= $p['direccion_id'] ?></td>
                            <td>$<?= number_format($p['total'], 2) ?></td>

                            <td>
                                <?php if ($p['estado'] == 'pendiente'): ?>
                                    <span class="badge bg-warning text-dark">Pendiente</span>
                                <?php elseif ($p['estado'] == 'preparando'): ?>
                                    <span class="badge bg-primary">Preparando</span>
                                <?php elseif ($p['estado'] == 'camino'): ?>
                                    <span class="badge bg-info">En Camino</span>
                                <?php elseif ($p['estado'] == 'entregado'): ?>
                                    <span class="badge bg-success">Entregado</span>
                                <?php endif; ?>
                            </td>

                            <td class="text-end">
                                <a href="<?= BASE_URL ?>repartidorPedidos/ver/<?= $p['id'] ?>" 
                                   class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-eye"></i> Ver
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
