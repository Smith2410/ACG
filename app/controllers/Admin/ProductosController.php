<?php

namespace Admin;

class ProductosController extends \Controller
{
    private $producto;

    public function __construct()
    {
        $this->producto = new \Producto();
    }

    /* ADMIN LISTADO */
    public function index()
    {
        $pagina = $_GET['page'] ?? 1;
        $porPagina = 10;
        $offset = ($pagina - 1) * $porPagina;

        $productos  = $this->producto->paginate($porPagina, $offset);
        $categorias = (new \Categoria())->activas();

        $this->view("admin/productos/index", compact("productos", "categorias"), "admin");
    }

    /* SUBIR IMAGEN */
    private function subirImagen()
    {
        if (!isset($_FILES['imagen']) || $_FILES['imagen']['error'] !== 0) {
            return null;
        }

        $permitidas = ['jpg', 'jpeg', 'png', 'webp'];
        $ext = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $permitidas)) {
            die("Extensión no permitida");
        }

        $dir = __DIR__ . '/../../public/img/productos/';
        if (!is_dir($dir)) mkdir($dir, 0777, true);

        $nombre = uniqid('img_') . "." . $ext;
        move_uploaded_file($_FILES['imagen']['tmp_name'], $dir . $nombre);

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
        $imagen = $this->subirImagen();

        $_POST['imagen'] = $imagen ?? "default.png";

        $this->producto->create($_POST);
        redirect("admin/productos");
    }

    /* EDITAR */
    public function editar($id)
    {
        $producto = $this->producto->find($id);
        $categorias = (new \Categoria())->activas();

        $this->view("admin/productos/editar", compact("producto", "categorias"), "admin");
    }

    /* ACTUALIZAR */
    public function actualizar($id)
    {
        $producto = $this->producto->find($id);

        $nueva = $this->subirImagen();

        if ($nueva) {
            $old = __DIR__ . '/../../public/img/productos/' . $producto['imagen'];
            if ($producto['imagen'] != "default.png" && file_exists($old)) unlink($old);
            $_POST['imagen'] = $nueva;
        } else {
            $_POST['imagen'] = $producto['imagen'];
        }

        $this->producto->update($id, $_POST);
        redirect("admin/productos");
    }

    /* CAMBIAR ESTADO */
    public function cambiarEstado($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') die("Método no permitido");

        $this->producto->update($id, ['estado' => $_POST['estado']]);
        echo "ok";
    }

    /* ELIMINAR */
    public function eliminar($id)
    {
        $producto = $this->producto->find($id);

        if (!$producto) die("Producto no encontrado.");

        if ($producto['imagen'] !== "default.png") {
            $ruta = __DIR__ . '/../../public/img/productos/' . $producto['imagen'];
            if (file_exists($ruta)) unlink($ruta);
        }

        $this->producto->destroy($id);
        redirect("admin/productos");
    }
}
