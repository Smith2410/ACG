<?php

class CategoriasController extends Controller
{
    private $categoria;

    public function __construct()
    {
        $this->categoria = new Categoria();
    }

    public function index()
    {
        $categorias = $this->categoria->all();
        $this->view("categorias/index", compact("categorias"));
    }

    public function crear()
    {
        $this->view("categorias/crear");
    }

    public function guardar()
    {
        $this->categoria->create($_POST);
        redirect("categorias");
    }

    public function editar($id)
    {
        $categoria = $this->categoria->find($id);
        $this->view("categorias/editar", compact("categoria"));
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
