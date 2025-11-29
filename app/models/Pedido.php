<?php

class Pedido extends Model
{
    protected $table = "pedidos";

    public function crear($data)
    {
        $sql = "INSERT INTO pedidos 
                (usuario_id, direccion_id, repartidor_id, estado, metodo_pago, total, fecha)
                VALUES (?, ?, NULL, 'pendiente', ?, ?, NOW())";

        $this->query($sql, [
            $data['usuario_id'],
            $data['direccion_id'],  // puede ser NULL
            $data['metodo_pago'],
            $data['total']
        ]);

        // OJO: la línea correcta para obtener el último ID
        return $this->db->lastInsertId();
    }
    public function find($id)
{
    return $this->query(
        "SELECT * FROM pedidos WHERE id = ?",
        [$id],
        true
    );
}

}
