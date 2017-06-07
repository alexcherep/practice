<?php

class Model
{
    protected $pdo, $table;
    protected $primaryKey = 'id';

    public function __construct()
    {
        $this->pdo = Db::instance();
    }

    public function query($sql, $params = [])
    {
        return $this->pdo->execute($sql, $params);
    }

    public function findAll()
    {
        $sql = 'SELECT * FROM '.$this->table;
        return $this->pdo->query($sql);
    }

    public function findOne($id, $field = '')
    {
        $field = $field ?: $this->primaryKey;
        $sql = "SELECT * FROM {$this->table} WHERE {$field} = ? LIMIT 1";
        return $this->pdo->query($sql, [$id]);
    }

    public function findBySql($sql, $params = [])
    {
        return $this->pdo->query($sql, $params);
    }

    public function getCategory()
    {
        $sql = 'SELECT alias FROM categories';
        return $this->pdo->query($sql);
    }
}