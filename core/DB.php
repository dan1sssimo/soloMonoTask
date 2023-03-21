<?php


namespace core;


class DB
{
    protected $pdo;

    protected $mySQLI;

    public function __construct($server, $login, $password, $database)
    {
        $this->pdo = new \PDO("mysql:host={$server};dbname={$database};charset=UTF8", $login, $password);
        $this->mySQLI = new \mysqli($server, $login, $password, $database);
    }

    public function select($table, $fields = "*", $where = null, $orderBy = null, $limit = null, $offset = null)
    {
        $fieldsStr = "*";
        if (is_string($fields))
            $fieldsStr = $fields;
        if (is_array($fields))
            $fieldsStr = implode(', ', $fields);
        $sql = "SELECT {$fieldsStr} FROM {$table}";
        if (is_array($where) && count($where) > 0) {
            $whereParts = [];
            foreach ($where as $key => $value)
                $whereParts [] = "{$key} = ?";
            $whereStr = implode(' AND ', $whereParts);
            $sql .= ' WHERE ' . $whereStr;
        }
        if (is_string($where))
            $sql .= ' WHERE ' . $where;
        if (is_string($orderBy)) {
            $sql .= ' ORDER BY ' . $orderBy;
        }
        if (!empty($limit)) {
            if (!empty($offset))
                $sql .= " LIMIT {$offset}, {$limit}";
            else
                $sql .= " LIMIT {$limit}";
        }
        $sth = $this->pdo->prepare($sql);
        if (is_array($where) && count($where) > 0)
            $sth->execute(array_values($where));
        else
            $sth->execute();
        return $sth->fetchAll();
    }

    public function insert($table, $row)
    {
        $fieldsStr = implode(', ', array_keys($row));
        $valueParts = [];
        foreach ($row as $key => $value)
            $valueParts [] = '?';
        $valuesStr = implode(', ', $valueParts);
        $sql = "INSERT INTO {$table} ({$fieldsStr}) VALUE ({$valuesStr})";
        $sth = $this->pdo->prepare($sql);
        $sth->execute(array_values($row));
        return $this->pdo->lastInsertId();
    }

    public function delete($table, $where)
    {
        $sql = "DELETE FROM {$table}";
        if (is_array($where) && count($where) > 0) {
            $whereParts = [];
            foreach ($where as $key => $value)
                $whereParts [] = "{$key} = ?";
            $whereStr = implode(' AND ', $whereParts);
            $sql .= ' WHERE ' . $whereStr;
        }
        if (is_string($where))
            $sql .= ' WHERE ' . $where;
        $sth = $this->pdo->prepare($sql);
        if (is_array($where) && count($where) > 0)
            $sth->execute(array_values($where));
        else
            $sth->execute();
    }

    public function update($table, $newRow, $where)
    {
        $sql = "UPDATE {$table} SET ";
        $setParts = [];
        $paramsArr = [];
        foreach ($newRow as $key => $value) {
            $setParts [] = "{$key} = ?";
            $paramsArr [] = $value;
        }
        $sql .= implode(', ', $setParts);
        if (is_array($where) && count($where) > 0) {
            $whereParts = [];
            foreach ($where as $key => $value) {
                $whereParts [] = "{$key} = ?";
                $paramsArr [] = $value;
            }
            $whereStr = implode(' AND ', $whereParts);
            $sql .= ' WHERE ' . $whereStr;
        }
        if (is_string($where))
            $sql .= ' WHERE ' . $where;
        $sth = $this->pdo->prepare($sql);
        $sth->execute($paramsArr);
    }

    public function selectJoinTables()
    {
        $sql = "SELECT product_category.id, product_category.category_name, COUNT(product.id) as total_count
        FROM product_category
        LEFT JOIN product ON product_category.id = product.category_id
        GROUP BY product_category.id";
        $sth = $this->pdo->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
    }

    public function testTask2()
    {
        $sql = ("SELECT * FROM categories");
        return $this->mySQLI->query($sql);
    }


}