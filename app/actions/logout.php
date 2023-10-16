<?php

include "../../vendor/guard/Guard.php";

if($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header('Location: ../../index.php');

    die();

}

session_start();

$guard = new Guard();

$guard->checkToken();

if(isset($_SESSION['user'])) {
    unset($_SESSION['user']);
}

header('Location: ../../index.php?p=login');