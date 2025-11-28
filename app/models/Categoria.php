<?php

class Categoria extends Model
{
    protected $table = "categorias";

    public function all()
    {
        return $this->query("SELECT * FROM categorias ORDER BY id DESC");
    }

    public function activas()
    {
        return $this->query("SELECT * FROM categorias WHERE estado = 1 ORDER BY nombre ASC");
    }

    public function find($id)
    {
        return $this->query("SELECT * FROM categorias WHERE id = ?", [$id], true);
    }

    public function create($data)
    {
        $sql = "INSERT INTO categorias (nombre, descripcion, estado) VALUES (?, ?, ?)";
        return $this->query($sql, [
            $data['nombre'],
            $data['descripcion'],
            $data['estado'] ?? 1
        ]);
    }

    public function update($id, $data)
    {
        $cols = [];
        $vals = [];
        
        foreach ($data as $key => $value) {
            $cols[] = "$key = ?";
            $vals[] = $value;
        }
        
        $vals[] = $id;
        
        $sql = "UPDATE categorias SET ".implode(", ", $cols)." WHERE id = ?";
        return $this->query($sql, $vals);
    }

    public function delete($id)
    {
        return $this->query("UPDATE categorias SET estado = 0 WHERE id = ?", [$id]);
    }

    public function destroy($id)
    {
        return $this->query("DELETE FROM categorias WHERE id = ?", [$id]);
    }
}
