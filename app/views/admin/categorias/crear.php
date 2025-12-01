<h3 class="fw-bold mb-3">Nueva Categoría</h3>

<form action="<?= BASE_URL ?>categorias/guardar" method="POST" class="row g-3">

    <div class="col-md-6">
        <label class="form-label fw-bold">Nombre</label>
        <input type="text" name="nombre" class="form-control" required>
    </div>

    <div class="col-12">
        <label class="form-label fw-bold">Descripción</label>
        <textarea name="descripcion" class="form-control"></textarea>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Estado</label>
        <select name="estado" class="form-select">
            <option value="1">Activa</option>
            <option value="0">Inactiva</option>
        </select>
    </div>

    <div class="col-12 text-end">
        <button class="btn btn-primary">Guardar</button>
    </div>

</form>
