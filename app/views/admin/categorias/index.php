<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="fw-bold">Categorías</h3>
    <a href="<?= BASE_URL ?>admin/categorias/crear" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Nueva Categoría
    </a>
</div>

<div class="table-responsive shadow-sm p-3 bg-white rounded-3">
    <table class="table table-hover align-middle" id="tabla-cat">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th width="180">Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($categorias as $c): ?>
            <tr>
                <td><?= $c['id'] ?></td>
                <td><?= $c['nombre'] ?></td>
                <td>
                    <div class="form-check form-switch">
                        <input type="checkbox" 
                               class="form-check-input toggle-estado" 
                               data-id="<?= $c['id'] ?>"
                               <?= $c['estado'] ? "checked" : "" ?>>
                    </div>
                </td>

                <td>
                    <a href="<?= BASE_URL ?>admin/categorias/editar/<?= $c['id'] ?>"
                       class="btn btn-primary btn-sm">Editar</a>

                    <a href="<?= BASE_URL ?>admin/categorias/eliminar/<?= $c['id'] ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('¿Eliminar categoría?')">
                       Eliminar
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
document.querySelectorAll(".toggle-estado").forEach(switchEl => {
    switchEl.addEventListener("change", () => {
        let id = switchEl.dataset.id;
        let estado = switchEl.checked ? 1 : 0;

        fetch("<?= BASE_URL ?>admin/categorias/cambiarEstado/" + id, {
            method: "POST",
            body: new URLSearchParams({ estado: estado })
        })
        .then(r => r.text())
        .then(res => {
            if (res.trim() !== "ok") {
                alert("Error al cambiar estado");
            }
        });
    });
});
</script>
