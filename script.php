<?php

require_once "init.php";

while (true) {
    //set switch here if need
    //$switch = Kernel::checkSwitch();
    $switch = true;
    if ($switch) {
        $file = Kernel::getRequest();
        if ($file !== false) {
            list($key, $response) = Kernel::dealRequest($file);
            Kernel::sendResponse($key, $response);
        } else {
            usleep(100000);
        }
    }
    usleep(10000);
}
