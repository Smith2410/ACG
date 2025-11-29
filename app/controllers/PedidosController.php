<?php

class PedidosController extends Controller
{
    private $pedidoModel;
    private $detalleModel;

    public function __construct()
    {
        $this->pedidoModel  = new Pedido();
        $this->detalleModel = new PedidoDetalle();
    }

    // Mostrar formulario de checkout
    public function checkout()
    {
        if (empty($_SESSION['carrito'])) {
            redirect("carrito");
            return;
        }

        // Usuario actual (simulación temporal, luego agregaremos login real)
        $usuario_id = 1;

        // Obtener direcciones (cuando implementemos módulo de direcciones)
        $direccion = 1;

        $carrito = $_SESSION['carrito'];

        $this->view("checkout/index", compact("carrito", "usuario_id", "direccion"));
    }

    // Guardar pedido
    public function procesar()
    {
        if (empty($_SESSION['carrito'])) {
            redirect("carrito");
            return;
        }

        $usuario_id    = $_POST['usuario_id'];
        $direccion_id  = $_POST['direccion_id'];
        $metodo_pago   = $_POST['metodo_pago'];
        $total         = $_POST['total'];

        // 1. Crear pedido
        $pedido_id = $this->pedidoModel->crear([
            "usuario_id"   => $usuario_id,
            "direccion_id" => $direccion_id,
            "metodo_pago"  => $metodo_pago,
            "total"        => $total
        ]);

        // 2. Crear detalles
        foreach ($_SESSION['carrito'] as $item) {
            $this->detalleModel->crear([
                "pedido_id"   => $pedido_id,
                "producto_id" => $item['id'],
                "cantidad"    => $item['cantidad'],
                "precio_unitario"      => $item['precio'],
                "subtotal"    => $item['cantidad'] * $item['precio']
            ]);
        }

        // 3. Vaciar carrito
        $_SESSION['carrito'] = [];

        redirect("pedidos/confirmacion/" . $pedido_id);
    }

    // Confirmación del pedido
    public function confirmacion($id)
    {
        $pedido = $this->pedidoModel->find($id);
        $detalle = $this->detalleModel->porPedido($id);

        $this->view("checkout/confirmacion", compact("pedido", "detalle"));
    }
}
