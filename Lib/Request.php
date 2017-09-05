<?php

class Request {

    public static $params;
    public static $payload;

    public static function get($key, $default = null) {

        return isset(self::$params[$key]) ? self::$params[$key] : $default;
    }

    public static function post($key, $default = null) {

        return isset(self::$payload[$key]) ? self::$payload[$key] : $default;
    }

    public static function params() {

        return self::$params;
    }

    public static function payload() {

        return self::$payload;
    }

    public static function checkArray($key) {

        $param = self::post($key);
        $array = !is_null($param) ? json_decode($param, true) : [];
        if (is_array($array) && !empty($array)) {
            return $array;
        }
        die;
    }
}