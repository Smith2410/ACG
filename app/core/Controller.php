<?php

class Controller
{
    protected function view($path, $data = [], $layout = "main")
    {
        // Convertir compact style
        extract($data, EXTR_SKIP);

        // Soporte para views en app/views/
        $viewFile = __DIR__ . "/../views/{$path}.php";

        if (!file_exists($viewFile)) {
            throw new Exception("View not found: $viewFile");
        }

        ob_start();
        require $viewFile;
        $content = ob_get_clean();

        // Cargar layout: app/views/layouts/{layout}.php
        $layoutFile = __DIR__ . "/../views/layouts/{$layout}.php";
        if (!file_exists($layoutFile)) {
            // fallback: echo content
            echo $content;
            return;
        }

        require $layoutFile;
    }
}
