<?php

class AuthController extends Controller
{
    private $usuario;

    public function __construct()
    {
        $this->usuario = new Usuario();
    }

    public function login()
    {
        $this->view("auth/login");
    }

    public function procesarLogin()
    {
        $email    = trim($_POST['email']);
        $password = trim($_POST['password']);

        $usuario = $this->usuario->findByEmail($email);

        if (!$usuario) {
            return $this->view("auth/login", [
                "error" => "Usuario no encontrado"
            ]);
        }

        if (!$usuario['estado']) {
            return $this->view("auth/login", [
                "error" => "Tu cuenta está inactiva"
            ]);
        }

        if (!password_verify($password, $usuario['password'])) {
            return $this->view("auth/login", [
                "error" => "Contraseña incorrecta"
            ]);
        }

        // Iniciar sesión
        Auth::login($usuario);

        // Redirección según rol
        switch ($usuario['rol']) {
            case 'admin':
                redirect("admin/dashboard");
                break;

            case 'repartidor':
                redirect("repartidor/pedidos");
                break;

            case 'cliente':
                redirect("tienda");
                break;
        }
    }

    public function logout()
    {
        Auth::logout();
        redirect("login");
    }
}
