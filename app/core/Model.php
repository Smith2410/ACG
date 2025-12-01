<?php

class Model
{
    protected $db;
    protected $table = "";

    public function __construct()
    {
        // Ajusta según tu config
        $cfg = require __DIR__ . "/../config/config.php";
        $host = $cfg['db_host'];
        $name = $cfg['db_name'];
        $user = $cfg['db_user'];
        $pass = $cfg['db_pass'];
        $charset = $cfg['db_charset'] ?? 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$name;charset=$charset";
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        $this->db = new PDO($dsn, $user, $pass, $opt);
    }

    /**
     * query: always returns PDOStatement on SELECT, or boolean for write.
     * If third param $single = true returns single row assoc array.
     */
    public function query($sql, $params = [], $single = false)
    {
        $stmt = $this->db->prepare($sql);
        $ok = $stmt->execute($params);

        // If query is SELECT, return results
        $command = strtolower(explode(' ', trim($sql))[0]);
        if ($command === 'select' || strpos(strtolower($sql), 'select') === 0) {
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($single) {
                return $rows[0] ?? null;
            }
            return $rows;
        }

        // For insert/update/delete return boolean
        return $ok;
    }

    public function lastInsertId()
    {
        return $this->db->lastInsertId();
    }
}
