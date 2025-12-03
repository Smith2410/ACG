<?php

namespace Admin;

class UsuariosController extends \Controller
{
    private $usuario;

    public function __construct()
    {
        AuthMiddleware::requireAdmin();
    }

    public function __construct()
    {
        $this->usuario = new \Usuarios();
    }

    public function index()
    {
        $pagina = $_GET['page'] ?? 1;
        $porPagina = 10;
        $offset = ($pagina - 1) * $porPagina;

        $usuarios = $this->usuario->paginate($porPagina, $offset);
        $total    = $this->usuario->count();

        $this->view("admin/usuarios/index", compact("usuarios", "pagina", "porPagina", "total"), "admin");
    }

    public function crear()
    {
        $roles = ["admin", "repartidor", "cliente"];
        $this->view("admin/usuarios/crear", compact("roles"), "admin");
    }

    public function guardar()
    {
        if ($this->usuario->findByEmail($_POST['email'])) {
            die("El email ya está registrado.");
        }

        $this->usuario->create($_POST);
        redirect("admin/usuarios");
    }

    public function editar($id)
    {
        $usuario = $this->usuario->find($id);
        if (!$usuario) redirect("admin/usuarios");

        $roles = ["admin", "repartidor", "cliente"];

        $this->view("admin/usuarios/editar", compact("usuario", "roles"), "admin");
    }

    public function actualizar($id)
    {
        if (trim($_POST['password']) === "") {
            unset($_POST['password']); // No actualizar password si viene vacío
        }

        $this->usuario->update($id, $_POST);
        redirect("admin/usuarios");
    }

    public function cambiarEstado($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') die("Método no permitido");

        $this->usuario->update($id, ['estado' => $_POST['estado']]);
        echo "ok";
    }

    public function eliminar($id)
    {
        $this->usuario->delete($id);
        redirect("admin/usuarios");
    }

    public function eliminarDefinitivo($id)
    {
        $this->usuario->destroy($id);
        redirect("admin/usuarios");
    }
}
