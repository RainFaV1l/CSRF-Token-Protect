<?php

class Guard
{
    public function __construct()
    {
        session_start();
    }

    public function checkToken(): void
    {

        if(!isset($_POST['_token']) || ($_POST['_token'] !== $_SESSION['_token']) || time() > $_SESSION['token_expiration']) {

            die('Invalid CSRF token!');

        }

    }
}