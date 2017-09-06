<?php

class Kernel {

    public static function setRequest($content) {

        if (!isset($content["key"])) {
            return false;
        }

        $file = TMP_DIR . '\Key_request.txt';
        $file = str_replace("Key", $content["key"], $file);
        $fp = fopen($file, "wb");
        fwrite($fp, json_encode($content));
        fclose($fp);

        return $file;
    }

    public static function dealRequest($file = null, $content = null) {

        if (!is_null($file)) {
            $content = json_decode(file_get_contents($file), true);
            // clean the request log here if need
            // exec("del $file");
        }
        $key = $content["key"];
        $request = $content["req"];
        $method = isset($request["method"]) ? $request["method"] : "get";
        $body = $request["body"];
        $url = $request["url"];
        $header = Http::getHeader($request["header"]);
        switch (strtoupper($method)) {
            case "GET" :
                $response = Http::get($url, $header);
                break;
            case "POST" :
                $response = Http::post($url, $body, $header);
                break;
            case "PUT" :
                $response = Http::put($url, $body, $header);
                break;
            default :
                $response = Http::call($url, $method, $header);
        }

        // deal resource
        $resource = [".jpg", ".png", ".gif", ".mp3", ".amr", ".mp4", ".avi"];
        $type = substr($url, -4);
        if (in_array($type, $resource)) {
            $response = base64_encode($response);
        }

        return [$key, $response];
    }

    public static function logResponse($key, $response) {

        $filename = $key . "_response.txt";
        $file = TMP_DIR . '\filename';
        $file = str_replace("filename", $filename, $file);
        $fp = fopen($file, "wb");
        fwrite($fp, $response);
        fclose($fp);
    }
}