<?php

namespace Admin;

class RepartidoresController extends \Controller
{
    private $pedidoModel;
    private $detalleModel;

    public function __construct()
    {
        AuthMiddleware::requireAdmin();
    }

    public function __construct()
    {
        $this->pedidoModel = new \Pedido();
        $this->detalleModel = new \PedidoDetalle();
    }

    // Pedidos asignados al repartidor
    public function index()
    {
        $repartidor_id = 1; // temporal hasta tener login real

        $pedidos = $this->pedidoModel->porRepartidor($repartidor_id);

        $this->view("admin/repartidores/index", compact("repartidor_id", "pedidos"), "admin");
    }

    // Ver detalles
    public function ver($id)
    {
        $pedido = $this->pedidoModel->find($id);
        $detalle = $this->detalleModel->porPedido($id);

        $this->view("repartidor/ver", compact("pedido", "detalle"));
    }

    // Actualizar estado
    public function estado($id)
    {
        $nuevo_estado = $_POST['estado'];

        $this->pedidoModel->actualizarEstado($id, $nuevo_estado);

        redirect("repartidorPedidos/ver/$id");
    }
}
