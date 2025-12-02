<?php ob_start(); ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2><i class="bi bi-basket"></i> Productos</h2>
    <a href="<?= BASE_URL ?>admin/productos/crear" class="btn btn-success">
        <i class="bi bi-plus-lg"></i> Nuevo producto
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($productos as $p): ?>
                    <tr>
                        <td style="width:110px">
                            <img src="<?= BASE_URL ?>img/productos/<?= htmlspecialchars($p['imagen']) ?>" alt="" class="img-fluid rounded" style="max-height:70px">
                        </td>
                        <td><?= htmlspecialchars($p['nombre']) ?></td>
                        <td>
                            <?php
                                $catName = '';
                                if (!empty($p['categoria'])) {
                                    $c = array_filter($categorias, fn($c) => $c['id'] == $p['categoria']);
                                    if (!empty($c)) {
                                        $first = array_values($c)[0];
                                        $catName = $first['nombre'];
                                    }
                                }
                                echo htmlspecialchars($catName);
                            ?>
                        </td>
                        <td>$<?= number_format($p['precio'], 2) ?></td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input estado-switch" type="checkbox" role="switch"
                                       data-id="<?= $p['id'] ?>"
                                       <?= $p['estado'] == 1 ? 'checked' : '' ?>>
                            </div>
                        </td>
                        <td class="text-end">
                            <a href="<?= BASE_URL ?>admin/productos/editar/<?= $p['id'] ?>" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <a href="<?= BASE_URL ?>admin/productos/eliminar/<?= $p['id'] ?>"
                               onclick="return confirm('¿Eliminar este producto? Se borrará la imagen si existe.')"
                               class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Paginación simple -->
        <?php
        $total = (new \Producto())->count();
        $pages = ceil($total / $porPagina);
        if ($pages > 1):
        ?>
        <nav class="mt-3">
            <ul class="pagination">
                <?php for ($i=1;$i<=$pages;$i++): ?>
                <li class="page-item <?= $i==$pagina ? 'active' : '' ?>">
                    <a class="page-link" href="<?= BASE_URL ?>admin/productos?page=<?= $i ?>"><?= $i ?></a>
                </li>
                <?php endfor; ?>
            </ul>
        </nav>
        <?php endif; ?>

    </div>
</div>

<?php
$content = ob_get_clean();
require __DIR__ . "/../../layouts/admin.php";
?>

<!-- JS para switch -->
<script>
document.addEventListener('DOMContentLoaded', function(){
    document.querySelectorAll('.estado-switch').forEach(function(el){
        el.addEventListener('change', function(){
            const id = this.dataset.id;
            const estado = this.checked ? 1 : 0;

            fetch('<?= BASE_URL ?>admin/productos/cambiarEstado/' + id, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'estado=' + encodeURIComponent(estado)
            })
            .then(r => r.json())
            .then(json => {
                if (json.status !== 'ok') {
                    alert('Error actualizando estado');
                }
            })
            .catch(err => {
                alert('Error de red');
            });
        });
    });
});
</script>
