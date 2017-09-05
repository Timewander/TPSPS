<?php

Request::$params = $_GET;
if (isset($_SERVER["CONTENT_TYPE"]) && strpos($_SERVER["CONTENT_TYPE"], "application/json") !== false) {
    $raw_post_data = file_get_contents('php://input', 'r');
    Request::$payload = json_decode($raw_post_data, true);
} else {
    Request::$payload = $_POST;
}