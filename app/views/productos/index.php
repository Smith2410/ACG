<style>
/* Switch verde/rojo */
.form-check-input:checked {
    background-color: #28a745 !important;
    border-color: #28a745 !important;
}
.form-check-input:not(:checked) {
    background-color: #dc3545 !important;
    border-color: #dc3545 !important;
}
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">Productos</h3>
    <a href="<?= BASE_URL ?>productos/crear" class="btn btn-success">
        + Nuevo Producto
    </a>
</div>

<!-- Filtros -->
<div class="row mb-3">
    
    <!-- Buscador -->
    <div class="col-md-4 mb-2">
        <input type="text" id="buscador" class="form-control" placeholder="Buscar productos...">
    </div>

    <!-- Filtro categoría -->
    <div class="col-md-4 mb-2">
        <select id="filtro-categoria" class="form-select">
            <option value="">Todas las categorías</option>
            <?php if (!empty($categorias)): ?>
                <?php foreach($categorias as $c): ?>
                    <option value="<?= strtolower($c['id']) ?>">
                        <?= $c['nombre'] ?>
                    </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
    </div>

    <!-- Filtro estado -->
    <div class="col-md-4 mb-2">
        <select id="filtro-estado" class="form-select">
            <option value="">Todos</option>
            <option value="1">Activos</option>
            <option value="0">Inactivos</option>
        </select>
    </div>

</div>

<!-- Tabla -->
<div class="table-responsive bg-white shadow-sm p-3 rounded-3">

<table class="table table-hover align-middle" id="tabla-productos">
    <thead class="table-light">
        <tr>
            <th>#</th>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Precio</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>

        <?php foreach($productos as $p): ?>
        <tr 
            data-categoria="<?= $p['categoria'] ?>" 
            data-estado="<?= $p['estado'] ?>"
        >
            <td><?= $p['id'] ?></td>

            <td>
                <img src="<?= BASE_URL ?>img/productos/<?= $p['imagen'] ?>" 
                     class="rounded" width="70">
            </td>

            <td><?= $p['nombre'] ?></td>
            <td><?= $p['categoria'] ?></td>
            <td>$<?= number_format($p['precio'],2) ?></td>

            <td>
                <div class="form-check form-switch">
                    <input class="form-check-input estado-switch"
                           type="checkbox"
                           data-id="<?= $p['id'] ?>"
                           <?= $p['estado'] == 1 ? 'checked' : '' ?>>
                </div>
            </td>

            <td>
                <a href="<?= BASE_URL ?>productos/editar/<?= $p['id'] ?>" 
                   class="btn btn-primary btn-sm">Editar</a>

                <a href="<?= BASE_URL ?>productos/eliminar/<?= $p['id'] ?>" 
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('¿Eliminar producto?')">
                   Eliminar
                </a>
            </td>
        </tr>
        <?php endforeach; ?>

    </tbody>
</table>

</div>

<!-- Paginación -->
<?php if (!empty($totalPaginas)): ?>
<nav class="mt-3">
    <ul class="pagination">
        <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
            <li class="page-item <?= $pagina == $i ? 'active' : '' ?>">
                <a class="page-link" href="<?= BASE_URL ?>productos?page=<?= $i ?>">
                    <?= $i ?>
                </a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>
<?php endif; ?>

<script>
// ---------------------
// Buscador en vivo
// ---------------------
document.getElementById('buscador').addEventListener('keyup', function() {
    const texto = this.value.toLowerCase();
    document.querySelectorAll('#tabla-productos tbody tr').forEach(fila => {
        fila.style.display = fila.innerText.toLowerCase().includes(texto) ? '' : 'none';
    });
});

// ---------------------
// Filtro por categoría y estado
// ---------------------
function aplicarFiltros() {
    const cat = document.getElementById('filtro-categoria').value;
    const estado = document.getElementById('filtro-estado').value;

    document.querySelectorAll('#tabla-productos tbody tr').forEach(fila => {
        const filaCat = fila.dataset.categoria;
        const filaEstado = fila.dataset.estado;

        let mostrar = true;

        if (cat && filaCat != cat) mostrar = false;
        if (estado && filaEstado != estado) mostrar = false;

        fila.style.display = mostrar ? "" : "none";
    });
}

document.getElementById('filtro-categoria').addEventListener('change', aplicarFiltros);
document.getElementById('filtro-estado').addEventListener('change', aplicarFiltros);

// ---------------------
// Switch AJAX
// ---------------------
document.querySelectorAll('.estado-switch').forEach(sw => {
    sw.addEventListener('change', async function () {
        const id = this.dataset.id;
        const estado = this.checked ? 1 : 0;

        const formData = new FormData();
        formData.append('estado', estado);

        await fetch("<?= BASE_URL ?>productos/cambiarEstado/" + id, {
            method: "POST",
            body: formData
        });
    });
});
</script>
