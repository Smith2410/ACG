<?php

class Router
{
    private static array $routes = [];
    private static string $groupPrefix = "";

    /** Registrar Ruta GET */
    public static function get(string $uri, string $action)
    {
        $final = trim(self::$groupPrefix . "/" . $uri, "/");
        self::$routes["GET"][$final] = $action;
    }

    /** Registrar Ruta POST */
    public static function post(string $uri, string $action)
    {
        $final = trim(self::$groupPrefix . "/" . $uri, "/");
        self::$routes["POST"][$final] = $action;
    }

    /** Grupos de rutas estilo Laravel */
    public static function group(string $prefix, callable $callback)
    {
        $old = self::$groupPrefix;
        self::$groupPrefix = trim($old . "/" . $prefix, "/");

        $callback();

        self::$groupPrefix = $old;
    }

    /** Resolver la ruta */
    public static function dispatch()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $uri = $_GET["url"] ?? "";
        $uri = trim($uri, "/");

        echo "<pre>DEBUG URI: '$uri'</pre>";

        $routes = self::$routes[$requestMethod] ?? [];

        foreach ($routes as $route => $action) {

            // Convertir {id} → regex
            $pattern = preg_replace('/\{([^\}]+)\}/', '([0-9a-zA-Z\-_]+)', $route);
            $pattern = "#^" . trim($pattern, "/") . "$#";

            if (preg_match($pattern, $uri, $matches)) {

                array_shift($matches);

                list($controller, $method) = explode("@", $action);

                // Convertir namespace a rutas
                $filePath = str_replace("\\", "/", $controller);
                $controllerFile = __DIR__ . "/../controllers/" . $filePath . ".php";

                if (!file_exists($controllerFile)) {
                    die("Controlador no encontrado: $controllerFile");
                }

                require_once $controllerFile;

                if (!class_exists($controller)) {
                    die("Clase no encontrada: $controller");
                }

                $instance = new $controller();

                if (!method_exists($instance, $method)) {
                    die("Método no encontrado: $method");
                }

                return call_user_func_array([$instance, $method], $matches);
            }
        }

        http_response_code(404);
        echo "<h1>404 - Página no encontrada</h1>";
        exit;
    }
}
