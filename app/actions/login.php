<?php

if($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST)) {

    header('Location: ../../index.php');

    die();

}

$pageName = basename($_SERVER['PHP_SELF']);

if($pageName !== 'login.php') return;

include "../../vendor/validator/Validator.php";
include "../../vendor/fluent/Fluent.php";
include "../../vendor/fluent/Query.php";
include "../../vendor/guard/Guard.php";
require_once '../../database/Database.php';
require_once '../../app/Models/User.php';

$connection = new \database\Database('localhost', 'csrf', 'root', '');

$connection = $connection->getConnection();

if(gettype($connection) === 'string') die($connection);

session_start();

$guard = new Guard();

$guard->checkToken();

$validator = new \vendor\Validator($_POST);

$data = array_filter($_POST,  function ($key) {
    return $key != '_token';
}, ARRAY_FILTER_USE_KEY);

$_SESSION['data'] = $data;

$rules = [
    'email' => ['required', 'email'],
    'password' => ['required'],
    'attempt' => ['login'],
];

$_SESSION['errors'] = $validator->validate($rules);

if(!empty($_SESSION['errors'])) {

    header('Location: ../../?p=login');

    die();

} else {

    $user = \User::query()->where('email', '=', $_SESSION['data']['email'])->where('password', '=', $_SESSION['data']['password'])->get();

    if(empty(!$user)) {

        unset($_SESSION['data']['email']);

        $_SESSION['user'] = $user;

    }

    header('Location: ../../index.php');

}