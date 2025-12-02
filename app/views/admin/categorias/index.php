<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="fw-bold">Categorías</h3>
    <a href="<?= BASE_URL ?>admin/categorias/crear" class="btn btn-success">+ Nueva Categoría</a>
</div>

<div class="table-responsive shadow-sm p-3 bg-white rounded-3">
    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($categorias as $c): ?>
            <tr>
                <td><?= $c['id'] ?></td>
                <td><?= $c['nombre'] ?></td>
                <td>
                    <span class="badge bg-<?= $c['estado'] ? "success" : "danger" ?>">
                        <?= $c['estado'] ? "Activa" : "Inactiva" ?>
                    </span>
                </td>
                <td>
                    <a href="<?= BASE_URL ?>admin/categorias/editar/<?= $c['id'] ?>"
                       class="btn btn-primary btn-sm">Editar</a>

                    <a href="<?= BASE_URL ?>admin/categorias/eliminar/<?= $c['id'] ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('¿Eliminar categoría?')">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
