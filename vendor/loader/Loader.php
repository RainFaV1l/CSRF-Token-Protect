<?php

class Loader
{
    public function loadDirectory(string $dirPath) : void {

        $files = scandir($dirPath);

        foreach ($files as $file) {

            if ($file !== '.' && $file !== '..') {

                require_once $dirPath . '/' . $file;

            }

        }

    }
}