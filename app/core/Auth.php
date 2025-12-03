<?php

class Auth
{
    public static function login($usuario)
    {
        $_SESSION['usuario'] = [
            'id'     => $usuario['id'],
            'nombre' => $usuario['nombre'],
            'email'  => $usuario['email'],
            'rol'    => $usuario['rol']
        ];
    }

    public static function user()
    {
        return $_SESSION['usuario'] ?? null;
    }

    public static function id()
    {
        return $_SESSION['usuario']['id'] ?? null;
    }

    public static function rol()
    {
        return $_SESSION['usuario']['rol'] ?? null;
    }

    public static function check()
    {
        return isset($_SESSION['usuario']);
    }

    public static function logout()
    {
        unset($_SESSION['usuario']);
        session_destroy();
    }

    public static function is($rol)
    {
        return self::check() && self::rol() === $rol;
    }
}
