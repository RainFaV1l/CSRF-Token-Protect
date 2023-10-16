<?php

require_once 'database/Database.php';

global $connection;

$connection = new \database\Database('localhost', 'csrf', 'root', '');

$connection = $connection->getConnection();

if(gettype($connection) === 'string') die($connection);

session_start();

$_SESSION['_token'] = bin2hex(openssl_random_pseudo_bytes(16));

$_SESSION['token_expiration'] = time() + (30 * 60);

require_once 'vendor/autoloader/autoloader.php';