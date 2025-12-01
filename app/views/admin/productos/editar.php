<?php $title = "Editar Producto"; ?>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="<?= BASE_URL ?>productos/actualizar/<?= $producto['id'] ?>" method="POST" class="row g-3" enctype="multipart/form-data">

            <div class="col-md-6">
                <label class="form-label fw-bold">Nombre</label>
                <input class="form-control" type="text" name="nombre" value="<?= $producto['nombre'] ?>">
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold">Precio</label>
                <input class="form-control" type="number" name="precio" value="<?= $producto['precio'] ?>" step="0.01">
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
                <label class="form-label fw-bold">Imagen actual</label><br>
                <img src="<?= BASE_URL ?>img/productos/<?= $producto['imagen'] ?>" 
                     width="120" class="rounded shadow-sm mb-2">

                <input type="file" name="imagen" class="form-control mt-2" accept="image/*">
                <small class="text-muted">Si seleccionas una nueva imagen, la anterior se reemplazará.</small>
            </div>

            <div class="col-12">
                <label class="form-label fw-bold">Descripción</label>
                <textarea class="form-control" name="descripcion"><?= $producto['descripcion'] ?></textarea>
            </div>

            <div class="col-12 text-end">
                <button class="btn btn-primary btn-lg">Guardar Producto</button>
            </div>

        </form>
    </div>
</div>
