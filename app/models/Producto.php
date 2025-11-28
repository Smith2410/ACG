<?php

class Producto extends Model
{
    protected $table = "productos";

    /* Productos visibles al cliente */
    public function activos()
    {
        return $this->query("SELECT * FROM productos WHERE estado = 1 ORDER BY id DESC");
    }

    /* Productos para el admin */
    public function all()
    {
        return $this->query("SELECT * FROM productos ORDER BY id DESC");
    }

    public function find($id)
    {
        return $this->query(
            "SELECT * FROM productos WHERE id = ?",
            [$id],
            true
        );
    }

    public function create($data)
    {
        $sql = "INSERT INTO productos (nombre, descripcion, precio, categoria, imagen, estado)
                VALUES (?, ?, ?, ?, ?, ?)";

        return $this->query($sql, [
            $data['nombre'],
            $data['descripcion'],
            $data['precio'],
            $data['categoria'],
            $data['imagen'],
            $data['estado'] ?? 1
        ]);
    }

    public function update($id, $data)
    {
        $cols = [];
        $vals = [];

        foreach ($data as $campo => $valor) {
            $cols[] = "$campo = ?";
            $vals[] = $valor;
        }

        // Agregar ID al final
        $vals[] = $id;

        // Construir SQL dinámico
        $sql = "UPDATE productos SET " . implode(", ", $cols) . " WHERE id = ?";

        return $this->query($sql, $vals);
    }

    public function paginate($limit, $offset)
    {
        $sql = "SELECT * FROM productos ORDER BY id DESC LIMIT $limit OFFSET $offset";
        return $this->query($sql); // importante: SIN fetchAll()
    }

    public function count()
    {
        $res = $this->query("SELECT COUNT(*) AS total FROM productos");
        return $res[0]['total'];
    }

    // Soft-delete (marca inactivo)
    public function delete($id)
    {
        $sql = "UPDATE productos SET estado = 0 WHERE id = ?";
        return $this->query($sql, [$id]);
    }

    // Hard-delete (borra fila definitivamente)
    public function destroy($id)
    {
        $sql = "DELETE FROM productos WHERE id = ?";
        return $this->query($sql, [$id]);
    }
}
