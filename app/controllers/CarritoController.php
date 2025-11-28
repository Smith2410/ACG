<?php

class CarritoController extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }
        $this->producto = new Producto();
    }

    // Mostrar el carrito
    public function index()
    {
        $carrito = $_SESSION['carrito'];
        $this->view("carrito/index", compact("carrito"));
    }

    // Agregar producto
    public function agregar($id)
    {
        $producto = $this->producto->find($id);

        if (!$producto) {
            redirect("productos");
            return;
        }

        if (!isset($_SESSION['carrito'][$id])) {

            $_SESSION['carrito'][$id] = [
                "id"        => $producto['id'],
                "nombre"    => $producto['nombre'],
                "precio"    => $producto['precio'],
                "imagen"    => $producto['imagen'],
                "cantidad"  => 1
            ];

        } else {

            $_SESSION['carrito'][$id]['cantidad']++;

        }

        redirect("carrito");
    }

    // Cambiar cantidad
    public function actualizar($id)
    {
        if (!isset($_SESSION['carrito'][$id])) return;

        $cantidad = $_POST['cantidad'] ?? 1;

        if ($cantidad < 1) $cantidad = 1;

        $_SESSION['carrito'][$id]['cantidad'] = $cantidad;

        redirect("carrito");
    }

    // Quitar producto
    public function quitar($id)
    {
        unset($_SESSION['carrito'][$id]);
        redirect("carrito");
    }

    // Vaciar carrito
    public function vaciar()
    {
        $_SESSION['carrito'] = [];
        redirect("carrito");
    }
}
