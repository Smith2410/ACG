<?php $title = "Nuevo Producto"; ?>

<div class="card shadow-sm">
    <div class="card-body">
        <h2 class="fw-bold mb-4">Nuevo Producto</h2>

        <form action="<?= BASE_URL ?>admin/productos/guardar" method="POST" class="row g-3" enctype="multipart/form-data">

            <div class="col-md-6">
                <label class="form-label fw-bold">Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold">Precio</label>
                <input type="number" step="0.01" name="precio" class="form-control" required>
            </div>

            <select name="categoria" class="form-select" required>
                <?php foreach ($categorias as $cat): ?>
                <option value="<?= $cat['id'] ?>" 
                    <?= isset($producto['categoria']) && $producto['categoria'] == $cat['id'] ? 'selected' : '' ?>>
                    <?= $cat['nombre'] ?>
                </option>
                <?php endforeach; ?>
            </select>

            <div class="col-md-12">
                <label class="form-label fw-bold">Imagen del producto</label>
                <input type="file" name="imagen" class="form-control" accept="image/*" required>
            </div>

            <div class="col-12">
                <label class="form-label fw-bold">Descripción</label>
                <textarea name="descripcion" rows="3" class="form-control"></textarea>
            </div>

            <div class="col-12 text-end">
                <button class="btn btn-primary btn-lg">Guardar Producto</button>
            </div>

        </form>
    </div>
</div>
