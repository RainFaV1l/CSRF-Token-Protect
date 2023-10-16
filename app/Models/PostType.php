<?php

class PostType extends \vendor\fluent\Fluent
{
    public static string $table_name = 'post_types';
    public function __construct()
    {
        $this->query = new \vendor\fluent\Query();
    }
}