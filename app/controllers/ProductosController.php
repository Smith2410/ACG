<?php

class ProductosController extends Controller
{
    private $producto;

    public function __construct()
    {
        $this->producto = new Producto();
    }

    /* Vista cliente */
    public function tienda()
    {
        $productos = $this->producto->activos();
        return $this->view("productos/tienda", ["productos" => $productos]);
    }

    /* Admin */
    public function index()
{
    $pagina = $_GET['page'] ?? 1;
    $porPagina = 10;
    $offset = ($pagina - 1) * $porPagina;

    $productos = $this->producto->paginate($porPagina, $offset);

    $categorias = (new Categoria())->activas(); // ✔ correcto
    

    $this->view("productos/index", compact("productos", "categorias", "pagina"));
}

    
    // Cargar Imagen
    private function subirImagen()
    {
        if (!isset($_FILES['imagen']) || $_FILES['imagen']['error'] != 0) {
            return null;
        }

        $dir = __DIR__ . '/../../public/img/productos/';

        // Crear carpeta si no existe
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        // Generar nombre único
        $ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
        $nombre = uniqid('img_') . '.' . $ext;

        $destino = $dir . $nombre;

        // Mover archivo
        move_uploaded_file($_FILES['imagen']['tmp_name'], $destino);

        return $nombre;
    }

    public function crear()
    {
        $categoriaModel = new Categoria();
        $categorias = $categoriaModel->activas();

        $this->view("productos/crear", compact("categorias"));
    }

    public function guardar()
    {
        $imagen = $this->subirImagen();

        $_POST['imagen'] = $imagen ?? "default.png";

        $this->producto->create($_POST);
        redirect("productos");
    }

    public function editar($id)
    {
        $producto = $this->producto->find($id);

        $categoriaModel = new Categoria();
        $categorias = $categoriaModel->activas();

        $this->view("productos/editar", compact("producto", "categorias"));
    }

    public function actualizar($id)
    {
        // Obtener producto actual
        $producto = $this->producto->find($id);

        // Si subió nueva imagen → reemplazar
        $nuevaImagen = $this->subirImagen();

        if ($nuevaImagen) {
            // Eliminar imagen anterior
            $rutaAnterior = __DIR__ . '/../../public/img/productos/' . $producto['imagen'];

            if (file_exists($rutaAnterior) && $producto['imagen'] != "default.png") {
                unlink($rutaAnterior);
            }

            $_POST['imagen'] = $nuevaImagen;
        } else {
            // Mantener la anterior
            $_POST['imagen'] = $producto['imagen'];
        }

        $this->producto->update($id, $_POST);
        redirect("productos");
    }

    public function cambiarEstado($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Método no permitido";
            return;
        }

        $estado = $_POST['estado'];

        // Actualización universal
        $this->producto->update($id, ['estado' => $estado]);

        echo "ok";
    }

    public function eliminar($id)
    {
        // Obtener producto actual
        $producto = $this->producto->find($id);

        if (!$producto) {
            // opcional: mostrar mensaje
            die("Producto no encontrado.");
        }

        // Ruta absoluta al archivo de imagen
        $rutaImagen = __DIR__ . '/../../public/img/productos/' . $producto['imagen'];

        // Solo intentar borrar si existe y no es la imagen por defecto
        if (!empty($producto['imagen']) && $producto['imagen'] != 'default.png') {
            if (file_exists($rutaImagen)) {
                // intentar eliminar y controlar errores
                if (!@unlink($rutaImagen)) {
                    // Si falla, puedes registrar/loggear el error y continuar con la eliminación en BD
                    error_log("No se pudo eliminar la imagen: $rutaImagen");
                    // Opcional: setear permisos y reintentar
                    @chmod($rutaImagen, 0777);
                    @unlink($rutaImagen);
                }
            } else {
                // archivo no encontrado — registrar por si acaso
                error_log("Imagen no encontrada al eliminar producto: $rutaImagen");
            }
        }

        // Borrar de la BD: si tu modelo hace soft-delete, añade método para borrado físico
        // Si tu modelo ya hace borrado físico con delete($id), úsalo.
        $this->producto->destroy($id); // ver modelo abajo

        // Redirigir
        redirect("productos");
    }

}
