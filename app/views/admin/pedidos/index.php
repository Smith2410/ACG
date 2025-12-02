<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">Gestión de Pedidos</h3>
</div>

<!-- FILTRO -->
<div class="mb-3">
    <form class="row g-2">
        <div class="col-auto">
            <select name="estado" class="form-select">
                <option value="">Todos</option>
                <option value="pendiente"   <?= $estado=='pendiente'?'selected':'' ?>>Pendiente</option>
                <option value="preparando"  <?= $estado=='preparando'?'selected':'' ?>>Preparando</option>
                <option value="camino"      <?= $estado=='camino'?'selected':'' ?>>En camino</option>
                <option value="entregado"   <?= $estado=='entregado'?'selected':'' ?>>Entregado</option>
            </select>
        </div>
        <div class="col-auto">
            <button class="btn btn-primary"><i class="bi bi-funnel"></i> Filtrar</button>
        </div>
    </form>
</div>

<!-- Tabla -->
<div class="table-responsive bg-white shadow-sm p-3 rounded-3">

    <table class="table table-hover align-middle" id="tabla-productos">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th class="text-end">Acciones</th>
            </tr>
        </thead>

        <tbody>
        <?php foreach ($pedidos as $p): ?>
            <tr>
                <td>#<?= $p['id'] ?></td>
                <td>Usuario <?= $p['usuario_id'] ?></td>
                <td>$<?= number_format($p['total'], 2) ?></td>
                <td><?= $p['fecha'] ?></td>
                <td>
                    <?php if ($p['estado']=='pendiente'): ?>
                        <span class="badge bg-warning text-dark">Pendiente</span>
                    <?php elseif ($p['estado']=='preparando'): ?>
                        <span class="badge bg-primary">Preparando</span>
                    <?php elseif ($p['estado']=='camino'): ?>
                        <span class="badge bg-info text-dark">En camino</span>
                    <?php elseif ($p['estado']=='entregado'): ?>
                        <span class="badge bg-success">Entregado</span>
                    <?php endif; ?>
                </td>
                <td class="text-end">
                    <a href="<?= BASE_URL ?>admin/pedidos/ver/<?= $p['id'] ?>" 
                       class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-eye"></i> Ver
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>

    </table>
</div>