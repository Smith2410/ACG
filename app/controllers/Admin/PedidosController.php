<?php

namespace Admin;

class PedidosController extends \Controller
{
    private $pedidoModel;
    private $detalleModel;

    public function __construct()
    {
        $this->pedidoModel  = new \Pedido();
        $this->detalleModel = new \PedidoDetalle();
    }

    public function index()
    {
        $estado = $_GET['estado'] ?? null;

        if ($estado) {
            $pedidos = $this->pedidoModel->porEstado($estado);
        } else {
            $pedidos = $this->pedidoModel->all();
        }

        $this->view("admin/pedidos/index", compact("pedidos", "estado"), "admin");
    }

    public function ver($id)
    {
        $pedido  = $this->pedidoModel->find($id);
        $detalle = $this->detalleModel->porPedido($id);

        $this->view("admin/pedidos/ver", compact("pedido", "detalle"));
    }

    public function estado($id)
    {
        $nuevoEstado = $_POST['estado'];

        $this->pedidoModel->cambiarEstado($id, $nuevoEstado);

        redirect("admin/pedidos/ver/" . $id);
    }
}
