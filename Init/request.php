<?php

$gets = $_GET;
if (isset($_SERVER["CONTENT_TYPE"]) && strpos($_SERVER["CONTENT_TYPE"], "application/json") !== false) {
    $raw_post_data = file_get_contents('php://input', 'r');
    $posts = json_decode($raw_post_data, true);
} else {
    $posts = $_POST;
}

Request::setParams($gets);
Request::setPayload($posts);