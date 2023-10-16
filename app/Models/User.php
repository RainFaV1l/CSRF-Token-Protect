<?php

use vendor\fluent\Fluent;

class User extends Fluent
{
    public static string $table_name = '';
    public function __construct()
    {
        $this->query = new \vendor\fluent\Query();
    }
}