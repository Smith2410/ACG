<?php ob_start(); ?>

<h3>Editar producto #<?= $producto['id'] ?></h3>

<div class="card shadow-sm p-3">
    <form action="<?= BASE_URL ?>admin/productos/actualizar/<?= $producto['id'] ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input name="nombre" class="form-control" required value="<?= htmlspecialchars($producto['nombre']) ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="3"><?= htmlspecialchars($producto['descripcion']) ?></textarea>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Precio</label>
                <input name="precio" type="number" step="0.01" class="form-control" required value="<?= $producto['precio'] ?>">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Categoría</label>
                <select name="categoria" class="form-select">
                    <option value="">-- Sin categoría --</option>
                    <?php foreach ($categorias as $c): ?>
                        <option value="<?= $c['id'] ?>" <?= $c['id'] == $producto['categoria'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($c['nombre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Estado</label>
                <select name="estado" class="form-select">
                    <option value="1" <?= $producto['estado']==1?'selected':'' ?>>Activo</option>
                    <option value="0" <?= $producto['estado']==0?'selected':'' ?>>Inactivo</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Imagen actual</label>
            <div class="mb-2">
                <img id="preview" src="<?= BASE_URL ?>img/productos/<?= htmlspecialchars($producto['imagen'] ?: 'default.png') ?>" style="max-height:140px" class="rounded shadow-sm">
            </div>

            <label class="form-label">Cambiar imagen (opcional)</label>
            <input type="file" name="imagen" accept="image/*" class="form-control" id="inputImagen">
        </div>

        <div class="d-flex gap-2">
            <a href="<?= BASE_URL ?>admin/productos" class="btn btn-outline-secondary">Cancelar</a>
            <button class="btn btn-primary">Actualizar</button>
        </div>
    </form>
</div>

<?php
$content = ob_get_clean();
require __DIR__ . "/../../layouts/admin.php";
?>

<script>
document.getElementById('inputImagen').addEventListener('change', function(e){
    const file = e.target.files[0];
    if (!file) return;
    const url = URL.createObjectURL(file);
    document.getElementById('preview').src = url;
});
</script>
