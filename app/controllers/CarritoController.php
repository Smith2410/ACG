<?php

class CarritoController extends Controller
{
    private Producto $producto; // Propiedad declarada

    public function __construct()
    {
        $this->producto = new Producto();

        // Iniciar la sesión si no está iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Inicializar el carrito si no existe
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }
    }

    // Mostrar los productos en el carrito
    public function index()
    {
        $carrito = $_SESSION['carrito'];
        $this->view("carrito/index", compact('carrito'), "layouts/main");
    }

    // Agregar un producto al carrito
    public function agregar($id)
    {
        $item = $this->producto->find($id);
        if (!$item) {
            header("Location: " . BASE_URL . "carrito");
            exit;
        }

        if (isset($_SESSION['carrito'][$id])) {
            $_SESSION['carrito'][$id]['cantidad']++;
        } else {
            $_SESSION['carrito'][$id] = [
                'id' => $item['id'],
                'nombre' => $item['nombre'],
                'precio' => $item['precio'],
                'imagen' => $item['imagen'],
                'cantidad' => 1
            ];
        }

        header("Location: " . BASE_URL . "carrito");
        exit;
    }

    // Actualizar la cantidad de un producto
    public function actualizar($id)
    {
        if (isset($_POST['cantidad']) && isset($_SESSION['carrito'][$id])) {
            $cantidad = (int)$_POST['cantidad'];
            if ($cantidad > 0) {
                $_SESSION['carrito'][$id]['cantidad'] = $cantidad;
            } else {
                unset($_SESSION['carrito'][$id]); // eliminar si es 0
            }
        }

        header("Location: " . BASE_URL . "carrito");
        exit;
    }

    // Eliminar un producto del carrito
    public function eliminar($id)
    {
        if (isset($_SESSION['carrito'][$id])) {
            unset($_SESSION['carrito'][$id]);
        }

        header("Location: " . BASE_URL . "carrito");
        exit;
    }

    // Vaciar todo el carrito
    public function vaciar()
    {
        $_SESSION['carrito'] = [];
        header("Location: " . BASE_URL . "carrito");
        exit;
    }
}
