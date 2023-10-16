<?php

namespace database;

class Database
{
    public object $connection;

    public function __construct(public string $host, public string $db_name, public string $username, public string $password)
    {

    }

    public function getConnection() : object | string {

        try {

            $dsn = "mysql:host=$this->host;dbname=$this->db_name";

            return new \PDO($dsn, $this->username, $this->password);

        } catch (\PDOException $exception) {

            return 'Возникла ошибка при подключении к базе данных! Текст ошибки:' . $exception . '.';

        }

    }
}