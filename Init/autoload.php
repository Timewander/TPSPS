<?php

function __autoload($className) {
    $paths = ["Lib/", ""];
    foreach ($paths as $path) {
        $classpath = ROOT_DIR . "/{$path}{$className}.php";
        if (file_exists($classpath)) {
            require_once($classpath);
            break;
        }
    }
}
