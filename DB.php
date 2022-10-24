<?php

class DB
{
    protected $pdo;

    function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=Igor_pavel', "Igor_pavel", "yMInd1yZDc");
        $this->pdo->query("SET NAMES utf8");
        $this->pdo->query("SET CHARACTER SET utf8");
        $this->pdo->query("SET character_set_connection=utf8");
    }

    function insert($table, $row)
    {
        $fieldStr = implode(', ', array_keys($row));
        $valuesParts = [];
        foreach ($row as $key => $value)
            $valuesParts [] = "'" . $value . "'";
        $valuesStr = implode(', ', $valuesParts);
        $sql = "INSERT INTO {$table} ({$fieldStr}) VALUES ({$valuesStr}) ON DUPLICATE KEY UPDATE date = VALUES (date)";
        $sth = $this->pdo->prepare($sql);
        $sth->execute();
    }
}