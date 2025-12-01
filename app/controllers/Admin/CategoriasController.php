<?php

namespace Admin;

class CategoriasController extends \Controller
{
    private $categoria;

    public function __construct()
    {
        $this->categoria = new \Categoria();
    }

    public function index()
    {
        $categorias = $this->categoria->all();
        $this->view("admin/categorias/index", compact("categorias"), "admin");
    }

    public function crear()
    {
        $this->view("admin/categorias/crear", compact("categorias"), "admin");
    }

    public function guardar()
    {
        $this->categoria->create($_POST);
        redirect("categorias");
    }

    public function editar($id)
    {
        $categoria = $this->categoria->find($id);
        $this->view("admin/categorias/editar", compact("categorias"), "admin");
    }

    public function actualizar($id)
    {
        $this->categoria->update($id, $_POST);
        redirect("categorias");
    }

    public function eliminar($id)
    {
        $this->categoria->delete($id);
        redirect("categorias");
    }

    public function eliminarDefinitivo($id)
    {
        $this->categoria->destroy($id);
        redirect("categorias");
    }
}
