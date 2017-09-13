<?php

function isMap($array) {

    $keys = array_keys($array);
    $flag = 0;
    foreach ($keys as $key) {
        if (!is_numeric($key) || $key != $flag) {
            return true;
        }
        $flag ++;
    }
    return false;
}

function log_info($title, $message) {

    $time = time();
    $file = LOG_DIR . "/" . date("Y-m-d") . ".txt";
    $time = date("Y-m-d H:i:s", $time);
    error_log("[$time] $title : $message\r\n", 3, $file);
}