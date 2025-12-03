<?php

class AuthMiddleware
{
    public static function requireLogin()
    {
        if (!Auth::check()) {
            redirect("login");
            exit;
        }
    }

    public static function requireAdmin()
    {
        if (!Auth::check() || Auth::rol() !== "admin") {
            redirect("login");
            exit;
        }
    }
}
