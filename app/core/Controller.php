<?php

class Controller
{
    protected function view($view, $data = [])
    {
        extract($data);

        // ruta del archivo real de la vista
        $viewFile = __DIR__ . "/../views/$view.php";

        // cargar el layout principal
        require __DIR__ . "/../views/layouts/main.php";
    }
}
