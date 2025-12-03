<?php

namespace Admin;

class CategoriasController extends \Controller
{
    private $categoria;

    public function __construct()
    {
        AuthMiddleware::requireAdmin();
    }

    public function __construct()
    {
        $this->categoria = new \Categoria();
    }

    public function index()
    {
        $estado   = $_GET['estado'] ?? "all";

        $sql = "SELECT * FROM categorias WHERE 1=1 ";
        $params = [];

        if ($estado === "1") {
            $sql .= " AND estado = 1 ";
        } elseif ($estado === "0") {
            $sql .= " AND estado = 0 ";
        }

        $sql .= " ORDER BY id DESC";

        $categorias = $this->categoria->raw($sql, $params);

        $this->view("admin/categorias/index", compact(
            "categorias",
            "estado"
        ), "admin");
    }

    public function crear()
    {
        $this->view("admin/categorias/crear", [], "admin");
    }

    public function guardar()
    {
        if (empty(trim($_POST['nombre']))) {
            redirect("admin/categorias/crear");
        }

        $this->categoria->create($_POST);
        redirect("admin/categorias");
    }

    public function editar($id)
    {
        $categoria = $this->categoria->find($id);

        if (!$categoria) redirect("admin/categorias");

        $this->view("admin/categorias/editar", compact("categoria"), "admin");
    }

    public function actualizar($id)
    {
        $this->categoria->update($id, $_POST);
        redirect("admin/categorias");
    }

    public function cambiarEstado($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') die("Método no permitido");

        $this->categoria->update($id, ["estado" => $_POST['estado']]);
        echo "ok";
    }

    public function eliminar($id)
    {
        $this->categoria->delete($id);
        redirect("admin/categorias");
    }

    public function eliminarDefinitivo($id)
    {
        $this->categoria->destroy($id);
        redirect("admin/categorias");
    }
}
