<h3 class="fw-bold mb-3">Editar Categoría</h3>

<form action="<?= BASE_URL ?>categorias/actualizar/<?= $categoria['id'] ?>" method="POST" class="row g-3">

    <div class="col-md-6">
        <label class="form-label fw-bold">Nombre</label>
        <input type="text" name="nombre" class="form-control" 
               value="<?= $categoria['nombre'] ?>" required>
    </div>

    <div class="col-12">
        <label class="form-label fw-bold">Descripción</label>
        <textarea name="descripcion" class="form-control"><?= $categoria['descripcion'] ?></textarea>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Estado</label>
        <select name="estado" class="form-select">
            <option value="1" <?= $categoria['estado'] ? "selected" : "" ?>>Activa</option>
            <option value="0" <?= !$categoria['estado'] ? "selected" : "" ?>>Inactiva</option>
        </select>
    </div>

    <div class="col-12 text-end">
        <button class="btn btn-primary">Actualizar</button>
    </div>

</form>
