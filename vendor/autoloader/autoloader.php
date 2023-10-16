<?php

require_once 'vendor/loader/Loader.php';

$loaderElements = [
    'vendor/fluent',
    'app/Models',
    'vendor/validator',
    'vendor/guard',
];

$loader = new Loader();

foreach ($loaderElements as $loaderElement) {

    $loader->loadDirectory($loaderElement);

}

include 'resources/views/app.php';