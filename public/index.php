<?php


// Activar errores (solo en desarrollo)
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

// Autoload simple
spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . '/../app/core/' . $class . '.php',
        __DIR__ . '/../app/controllers/' . $class . '.php',
        __DIR__ . '/../app/models/' . $class . '.php',
    ];

    foreach ($paths as $file) {
        if (file_exists($file)) {
            require $file;
            return;
        }
    }
});


// Helpers
require __DIR__ . '/../app/core/helpers.php';

// Iniciar Router
Router::dispatch();
