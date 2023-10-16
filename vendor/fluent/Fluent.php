<?php

namespace vendor\fluent;

class Fluent
{
    protected $query;

    public static string $table_name = '';

    public function where(string $field, string $operator, string $value) : object
    {
        $this->query->setCondition($field, $operator, $value);

        return $this;
    }

    public function generateSelectSql(array $data) : string | array
    {
        if(empty($data)) die('Error!');

        $className = static::class;

        if (class_exists($className)) {

            $sql = 'SELECT * FROM ' . $className::$table_name;

        }

        $prepare = [];

        if(empty($data['conditions'])) return $sql;

        $sql = $sql . ' WHERE ';

        $counter = 0;

        foreach ($data['conditions'] as $condition) {

            $sql = $sql . $condition['field'] . $condition['operator'] . ':' . $condition['field'];

            $prepare[':' . $condition['field']] = $condition['value'];

            $counter++;

            if(empty($data['conditions'][$counter++])) {

                break;

            }

            $sql = $sql . ' AND ';

        }

        return [
            'sql' => $sql,
            'prepare' => $prepare
        ];
    }

    public function insert(array $data) : bool
    {
        $columns = implode(", ", array_keys($data));

        $values = array_map(function ($value) {

            return ":$value";

        }, array_keys($data));

        global $connection;

        $stmt = $connection->prepare('INSERT INTO ' . static::$table_name . " ($columns) VALUES (" . implode(", ", $values) . ")");

        foreach ($data as $key => $value) {

            $stmt->bindValue(":$key", $value);

        }

        return $stmt->execute();
    }

    public function isProtectedQuery($data) : object
    {
        global $connection;

        if(is_array($data) && !empty($data['prepare'])) {

            $query = $connection->prepare($data['sql']);

            $query->execute($data['prepare']);

        } else {

            $query = $connection->query($data);

        }

        return $query;
    }

    public function first() : mixed {

        $data = $this->generateSelectSql($this->query->execute());

        $query = $this->isProtectedQuery($data);

        return $query->fetch(\PDO::FETCH_ASSOC);

    }

    public function get() : array {

        $data = $this->generateSelectSql($this->query->execute());

        $query = $this->isProtectedQuery($data);

        return $query->fetchAll(\PDO::FETCH_ASSOC);

    }

    public static function query() : object {

        if(!empty(static::$table_name)) return new static();

        $className = static::class;

        $classNameTable = preg_replace('/(?<!^)([A-Z])/', '_$1', $className);

        $classNameTable = strtolower($classNameTable) . 's';

        if (class_exists($className)) {

            $className::$table_name = $classNameTable;

        }

        return new static();

    }
}