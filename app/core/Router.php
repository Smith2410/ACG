<?php
class Router
{
    public static function dispatch()
    {
        $url = $_GET['url'] ?? "";
        $url = trim($url, "/");

        if ($url === "") {
            $controllerClass = "HomeController";
            $method = "index";
            $params = [];
            $controllerFile = __DIR__ . "/../controllers/$controllerClass.php";
        } else {
            $segments = explode("/", $url);

            // If first segment is a folder under controllers (Admin, Cliente, Api, etc.)
            $first = ucfirst($segments[0]);
            if (is_dir(__DIR__ . "/../controllers/" . $first)) {
                $namespace = $first;
                array_shift($segments); // remove namespace
                $ctrl = isset($segments[0]) && $segments[0] !== "" ? ucfirst($segments[0]) . "Controller" : "DashboardController";
                array_shift($segments);
                $controllerFile = __DIR__ . "/../controllers/$namespace/$ctrl.php";
                $controllerClass = $namespace . "\\" . $ctrl;
            } else {
                // root controllers
                $ctrl = isset($segments[0]) && $segments[0] !== "" ? ucfirst($segments[0]) . "Controller" : "HomeController";
                array_shift($segments);
                $controllerFile = __DIR__ . "/../controllers/$ctrl.php";
                $controllerClass = $ctrl;
            }

            $method = $segments[0] ?? "index";
            array_shift($segments);
            $params = $segments;
        }

        if (!file_exists($controllerFile)) {
            http_response_code(404);
            die("Controlador no encontrado: $controllerClass (file: $controllerFile)");
        }

        require_once $controllerFile;

        if (!class_exists($controllerClass)) {
            http_response_code(500);
            die("Clase controlador no encontrada: $controllerClass");
        }

        $controller = new $controllerClass();

        if (!method_exists($controller, $method)) {
            http_response_code(404);
            die("Método no encontrado: $method");
        }

        return call_user_func_array([$controller, $method], $params);
    }
}
