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

    /** GRUPOS de rutas estilo Laravel */
    public static function group(string $prefix, callable $callback)
    {
        $old = self::$groupPrefix;

        // Aplicar nuevo prefijo al grupo
        self::$groupPrefix = trim($old . "/" . $prefix, "/");

        // Ejecutar rutas del grupo
        $callback();

        // Restaurar prefijo anterior
        self::$groupPrefix = $old;
    }

    /** Registrar GET dentro de un grupo */
    public static function groupGet(string $uri, string $action)
    {
        self::get($uri, $action);
    }

    /** Registrar POST dentro de un grupo */
    public static function groupPost(string $uri, string $action)
    {
        self::post($uri, $action);
    }

    /** Resolver la ruta */
    public static function dispatch()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $uri = trim($uri, "/");

        // Eliminar carpeta "ACG/public" si aparece en la URI
        $projectFolder = "ACG/public";

        if (str_starts_with($uri, $projectFolder)) {
            $uri = substr($uri, strlen($projectFolder));
            $uri = trim($uri, "/");
        }

        echo "<pre>DEBUG URI: '$uri'</pre>";

        $routes = self::$routes[$requestMethod] ?? [];

        foreach ($routes as $route => $action) {

            // Convertir {id} → regex
            $pattern = preg_replace('/\{([^\}]+)\}/', '([0-9a-zA-Z\-_]+)', $route);
            $pattern = "#^" . trim($pattern, "/") . "$#";

            if (preg_match($pattern, $uri, $matches)) {

                array_shift($matches);

                list($controller, $method) = explode("@", $action);

                // Convertir namespace a ruta física
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
