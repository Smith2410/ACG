<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="fw-bold">Usuarios</h3>
    <a href="<?= BASE_URL ?>admin/usuarios/crear" class="btn btn-success">
        <i class="bi bi-person-plus"></i> Nuevo Usuario
    </a>
</div>

<div class="table-responsive bg-white p-3 shadow-sm rounded-3">
    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($usuarios as $u): ?>
            <tr>
                <td><?= $u['id'] ?></td>
                <td><?= $u['nombre'] ?></td>
                <td><?= $u['email'] ?></td>
                <td>
                    <span class="badge bg-info text-dark"><?= $u['rol'] ?></span>
                </td>
                <td>
                    <input type="checkbox" class="switch-estado"
                        data-id="<?= $u['id'] ?>"
                        <?= $u['estado'] ? "checked" : "" ?>>
                </td>
                <td>
                    <a href="<?= BASE_URL ?>admin/usuarios/editar/<?= $u['id'] ?>"
                       class="btn btn-primary btn-sm">Editar</a>

                    <a href="<?= BASE_URL ?>admin/usuarios/eliminar/<?= $u['id'] ?>"
                       onclick="return confirm('¿Eliminar usuario?')"
                       class="btn btn-danger btn-sm">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
document.querySelectorAll(".switch-estado").forEach(sw => {
    sw.addEventListener("change", () => {
        let id = sw.dataset.id;
        let estado = sw.checked ? 1 : 0;

        fetch("<?= BASE_URL ?>admin/usuarios/cambiarEstado/" + id, {
            method: "POST",
            body: new URLSearchParams({estado})
        });
    });
});
</script>
