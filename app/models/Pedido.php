<?php

class Pedido extends Model
{
    protected $table = "pedidos";

    public function all()
    {
        return $this->query("SELECT * FROM pedidos ORDER BY id DESC");
    }

    public function porEstado($estado)
    {
        return $this->query(
            "SELECT * FROM pedidos WHERE estado = ? ORDER BY id DESC",
            [$estado]
        );
    }

    public function cambiarEstado($id, $estado)
    {
        return $this->query(
            "UPDATE pedidos SET estado = ? WHERE id = ?",
            [$estado, $id]
        );
    }

    

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

    public function count()
    {
        $res = $this->query("SELECT COUNT(*) AS total FROM pedidos");

        // Si query devolvió array:
        if (is_array($res) && isset($res[0]['total'])) {
            return $res[0]['total'];
        }

        return 0;
    }

    public function totalVentas()
    {
        $res = $this->query("SELECT SUM(total) AS total FROM pedidos WHERE estado = 'entregado'");

        if (is_array($res) && isset($res[0]['total'])) {
            return $res[0]['total'] ?? 0;
        }

        return 0;
    }

    public function porUsuario($usuario_id)
    {
        return $this->query(
            "SELECT * FROM pedidos WHERE usuario_id = ? ORDER BY id DESC",
            [$usuario_id]
        );
    }
    public function porRepartidor($repartidor_id)
    {
        return $this->query(
            "SELECT * FROM pedidos WHERE repartidor_id = ? ORDER BY id DESC",
            [$repartidor_id]
        );
    }

    public function actualizarEstado($id, $estado)
    {
        return $this->query(
            "UPDATE pedidos SET estado = ? WHERE id = ?",
            [$estado, $id]
        );
    }

}
