<?php

$pages = [
    'login',
    'register',
];

if(isset($_GET['p'])) {

    if(in_array($_GET['p'], $pages)) {
        include 'resources/views/' . $_GET['p'] . '.php';
    }

} else {

    include 'resources/views/start.php';

}