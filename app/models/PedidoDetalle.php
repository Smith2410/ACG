<?php

class PedidoDetalle extends Model
{
    protected $table = "pedido_detalle";

    public function crear($data)
    {
        $sql = "INSERT INTO pedido_detalle (pedido_id, producto_id, cantidad, precio_unitario, subtotal)
                VALUES (?, ?, ?, ?, ?)";

        return $this->query($sql, [
            $data['pedido_id'],
            $data['producto_id'],
            $data['cantidad'],
            $data['precio_unitario'],
            $data['subtotal']
        ]);
    }

    public function porPedido($id)
    {
        return $this->query("SELECT * FROM pedido_detalle WHERE pedido_id = ?", [$id]);
    }
}
