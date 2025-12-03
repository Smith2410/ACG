<?php

class Usuarios extends Model
{
    protected $table = "usuarios";

    public function all()
    {
        return $this->query("SELECT * FROM usuarios ORDER BY id DESC");
    }

    public function activos()
    {
        return $this->query("SELECT * FROM usuarios WHERE estado = 1 ORDER BY id DESC");
    }

    public function find($id)
    {
        return $this->query("SELECT * FROM usuarios WHERE id = ?", [(int)$id], true);
    }

    public function findByEmail($email)
    {
        return $this->query("SELECT * FROM usuarios WHERE email = ?", [$email], true);
    }

    public function create($data)
    {
        $sql = "INSERT INTO usuarios (nombre, email, password, rol, estado)
                VALUES (?, ?, ?, ?, ?)";

        return $this->query($sql, [
            trim($data['nombre']),
            trim($data['email']),
            password_hash($data['password'], PASSWORD_DEFAULT),
            $data['rol'],
            $data['estado'] ?? 1
        ]);
    }

    public function update($id, $data)
    {
        $cols = [];
        $vals = [];

        foreach ($data as $key => $value) {
            if ($key === "password" && $value !== "") {
                $value = password_hash($value, PASSWORD_DEFAULT);
            }

            if ($key === "password" && $value === "") continue;

            $cols[] = "$key = ?";
            $vals[] = $value;
        }

        $vals[] = (int)$id;

        $sql = "UPDATE usuarios SET " . implode(", ", $cols) . " WHERE id = ?";
        return $this->query($sql, $vals);
    }

    public function delete($id)
    {
        return $this->query("UPDATE usuarios SET estado = 0 WHERE id = ?", [(int)$id]);
    }

    public function destroy($id)
    {
        return $this->query("DELETE FROM usuarios WHERE id = ?", [(int)$id]);
    }

    public function paginate($limit, $offset)
    {
        $limit  = (int)$limit;
        $offset = (int)$offset;

        return $this->query("SELECT * FROM usuarios ORDER BY id DESC LIMIT $limit OFFSET $offset");
    }

    public function count()
    {
        $res = $this->query("SELECT COUNT(*) AS total FROM usuarios");
        return $res[0]["total"] ?? 0;
    }
}
