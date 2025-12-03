<?php

namespace Admin;

class ProductosController extends \Controller
{
    private $producto;

    public function __construct()
    {
        AuthMiddleware::requireAdmin();
    }

    public function __construct()
    {
        $this->producto = new \Producto();
    }

    /* ADMIN LISTADO */
    public function index()
    {
        $pagina = max(1, intval($_GET['page'] ?? 1));
        $porPagina = 10;
        $offset = ($pagina - 1) * $porPagina;

        $productos  = $this->producto->paginate($porPagina, $offset);
        $categorias = (new \Categoria())->activas();

        $this->view("admin/productos/index", compact("productos", "categorias", "pagina", "porPagina"), "admin");
    }

    /* SUBIR IMAGEN (mejorada: extensión + MIME + tamaño) */
    private function subirImagen()
    {
        if (!isset($_FILES['imagen']) || $_FILES['imagen']['error'] !== 0) {
            return null;
        }

        // Validaciones
        $permitidas = ['jpg', 'jpeg', 'png', 'webp'];
        $maxBytes = 2 * 1024 * 1024; // 2MB

        $fileTmp  = $_FILES['imagen']['tmp_name'];
        $fileName = $_FILES['imagen']['name'];
        $fileSize = $_FILES['imagen']['size'];

        $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        if (!in_array($ext, $permitidas)) {
            return null; // no permitida
        }

        // Validar MIME real
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $fileTmp);
        finfo_close($finfo);
        $allowMime = ['image/jpeg','image/png','image/webp'];
        if (!in_array($mime, $allowMime)) {
            return null;
        }

        if ($fileSize > $maxBytes) {
            return null;
        }

        $dir = __DIR__ . '/../../../public/img/productos/';
        if (!is_dir($dir)) mkdir($dir, 0777, true);

        $nombre = uniqid('img_') . "." . $ext;
        if (!move_uploaded_file($fileTmp, $dir . $nombre)) {
            return null;
        }

        return $nombre;
    }

    /* CREAR */
    public function crear()
    {
        $categorias = (new \Categoria())->activas();
        $this->view("admin/productos/crear", compact("categorias"), "admin");
    }

    /* GUARDAR */
    public function guardar()
    {
        // Validaciones básicas
        $nombre = trim($_POST['nombre'] ?? '');
        $precio = $_POST['precio'] ?? null;

        if ($nombre === '' || !is_numeric($precio)) {
            // Podrías redirigir con error; aquí simple die para debug
            die("Nombre y precio son obligatorios.");
        }

        $imagen = $this->subirImagen();
        $_POST['imagen'] = $imagen ?? "default.png";

        // Estado default 1 si no enviado
        if (!isset($_POST['estado'])) $_POST['estado'] = 1;

        $this->producto->create([
            'nombre' => $_POST['nombre'],
            'descripcion' => $_POST['descripcion'] ?? '',
            'precio' => floatval($_POST['precio']),
            'categoria' => $_POST['categoria'] ?: null,
            'imagen' => $_POST['imagen'],
            'estado' => $_POST['estado']
        ]);

        redirect("admin/productos");
    }

    /* EDITAR */
    public function editar($id)
    {
        $producto = $this->producto->find($id);
        if (!$producto) redirect("admin/productos");

        $categorias = (new \Categoria())->activas();
        $this->view("admin/productos/editar", compact("producto", "categorias"), "admin");
    }

    /* ACTUALIZAR */
    public function actualizar($id)
    {
        $producto = $this->producto->find($id);
        if (!$producto) redirect("admin/productos");

        $nueva = $this->subirImagen();

        if ($nueva) {
            // Eliminar anterior si no es default
            $old = __DIR__ . '/../../../public/img/productos/' . $producto['imagen'];
            if (!empty($producto['imagen']) && $producto['imagen'] != "default.png" && file_exists($old)) {
                @unlink($old);
            }
            $imagenFinal = $nueva;
        } else {
            $imagenFinal = $producto['imagen'] ?? 'default.png';
        }

        // Validaciones básicas
        $nombre = trim($_POST['nombre'] ?? '');
        $precio = $_POST['precio'] ?? null;
        if ($nombre === '' || !is_numeric($precio)) {
            die("Nombre y precio son obligatorios.");
        }

        $this->producto->update($id, [
            'nombre' => $_POST['nombre'],
            'descripcion' => $_POST['descripcion'] ?? '',
            'precio' => floatval($_POST['precio']),
            'categoria' => $_POST['categoria'] ?: null,
            'imagen' => $imagenFinal,
            'estado' => $_POST['estado'] ?? 1
        ]);

        redirect("admin/productos");
    }

    /* CAMBIAR ESTADO (AJAX) */
    public function cambiarEstado($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo "Método no permitido";
            return;
        }

        $estado = isset($_POST['estado']) && ($_POST['estado'] == 1 || $_POST['estado'] == 0) ? intval($_POST['estado']) : 0;

        $this->producto->update($id, ['estado' => $estado]);

        header('Content-Type: application/json');
        echo json_encode(['status' => 'ok']);
    }

    /* ELIMINAR */
    public function eliminar($id)
    {
        $producto = $this->producto->find($id);

        if (!$producto) {
            die("Producto no encontrado.");
        }

        if (!empty($producto['imagen']) && $producto['imagen'] !== "default.png") {
            $ruta = __DIR__ . '/../../../public/img/productos/' . $producto['imagen'];
            if (file_exists($ruta)) @unlink($ruta);
        }

        $this->producto->destroy($id);
        redirect("admin/productos");
    }
}
