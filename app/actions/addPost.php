<?php

if($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST)) {

    header('Location: ../../index.php');

    die();

}

include "../../vendor/validator/Validator.php";
include "../../vendor/fluent/Fluent.php";
include "../../vendor/guard/Guard.php";
include "../../vendor/fluent/Query.php";
require_once '../../database/Database.php';
require_once '../../app/Models/Post.php';

$connection = new \database\Database('localhost', 'csrf', 'root', '');

$connection = $connection->getConnection();

if(gettype($connection) === 'string') die($connection);

session_start();

$guard = new Guard();

$guard->checkToken();

if(!isset($_SESSION['user'])) {

    header('Location: ../../index.php');

    die();

}

$validator = new \vendor\Validator($_POST);

$rules = [
    'title' => ['required', 'string'],
    'description' => ['required', 'string'],
    'post_type_id' => ['required', 'string'],
];

$_SESSION['errors'] = $validator->validate($rules);

$data = array_filter($_POST,  function ($key) {
    return $key != '_token';
}, ARRAY_FILTER_USE_KEY);

$_SESSION['data'] = $data;

if(!empty($_SESSION['errors'])) {

    header('Location: ../../index.php');

    die();

} else {

    Post::query()->insert($_SESSION['data']);

    unset($_SESSION['data']);

    header('Location: ../../index.php');

    die();

}