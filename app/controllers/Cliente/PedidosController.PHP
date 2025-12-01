<?php

namespace Cliente;

class PedidosController extends \Controller
{
    private $pedidoModel;
    private $detalleModel;

    public function __construct()
    {
        $this->pedidoModel  = new \Pedido();
        $this->detalleModel = new \PedidoDetalle();
    }

    // LISTA DE PEDIDOS DEL CLIENTE
    public function index()
    {
        $usuario_id = 1; // temporal hasta implementar login real

        $pedidos = $this->pedidoModel->porUsuario($usuario_id);

        $this->view("cliente_pedidos/index", compact("pedidos"));
    }

    // DETALLES DE UN PEDIDO
    public function ver($id)
    {
        $pedido = $this->pedidoModel->find($id);
        $detalle = $this->detalleModel->porPedido($id);

        $this->view("cliente_pedidos/ver", compact("pedido", "detalle"));
    }
}
