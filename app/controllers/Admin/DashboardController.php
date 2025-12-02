<?php

namespace Admin;

class DashboardController extends \Controller
{
    public function index()
    {
        $productoModel = new \Producto();
        $pedidoModel   = new \Pedido();

        $totalProductos = $productoModel->count();
        $totalPedidos   = $pedidoModel->count();
        $totalVentas    = $pedidoModel->totalVentas();

        $this->view("admin/index", compact("totalProductos", "totalPedidos", "totalVentas"), "admin");
    }
}
