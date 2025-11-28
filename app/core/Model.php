<?php

class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    protected function query($sql, $params = [], $single = false)
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        if ($single) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
