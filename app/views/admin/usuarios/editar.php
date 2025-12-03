<h3 class="fw-bold mb-3">Editar Usuario</h3>

<form action="<?= BASE_URL ?>admin/usuarios/actualizar/<?= $usuario['id'] ?>" method="POST" class="row g-3">

    <div class="col-md-6">
        <label class="form-label fw-bold">Nombre</label>
        <input type="text" name="nombre" class="form-control"
               value="<?= $usuario['nombre'] ?>" required>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold">Email</label>
        <input type="email" name="email" class="form-control"
               value="<?= $usuario['email'] ?>" required>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold">Password (opcional)</label>
        <input type="password" name="password" class="form-control">
        <small class="text-muted">Déjalo vacío para no cambiarlo</small>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Rol</label>
        <select name="rol" class="form-select">
            <?php foreach ($roles as $r): ?>
                <option value="<?= $r ?>" <?= $usuario['rol'] == $r ? "selected" : "" ?>>
                    <?= ucfirst($r) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Estado</label>
        <select name="estado" class="form-select">
            <option value="1" <?= $usuario['estado'] ? "selected" : "" ?>>Activo</option>
            <option value="0" <?= !$usuario['estado'] ? "selected" : "" ?>>Inactivo</option>
        </select>
    </div>

    <div class="col-12 text-end">
        <button class="btn btn-primary">Actualizar</button>
    </div>
</form>
