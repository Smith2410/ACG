<?php

class Router
{
    public static function dispatch()
    {
        
        $httpMethod = $_SERVER['REQUEST_METHOD']; // 'GET' o 'POST'

        $url = $_GET['url'] ?? '';
        $url = trim($url, '/');
        $parts = explode('/', $url);

        $controllerName = !empty($parts[0]) ? ucfirst($parts[0]) . 'Controller' : 'HomeController';
        $method = $parts[1] ?? 'index';
        $param = $parts[2] ?? null;

        $controllerFile = __DIR__ . "/../controllers/$controllerName.php";

        if (!file_exists($controllerFile)) {
            die("Controlador no encontrado: $controllerName");
        }

        require $controllerFile;

        $controller = new $controllerName();

        if (!method_exists($controller, $method)) {
            die("Método no encontrado: $method");
        }

        if ($param) {
            $controller->$method($param);
        } else {
            $controller->$method();
        }
    }
}

