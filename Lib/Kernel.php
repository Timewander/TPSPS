<?php

class Kernel {

    public static function getRequest() {

        $chrome = CHROME;
        $request = REQ;
        exec("$chrome $request");

        $filename = TMP_DIR . '\Key_request.txt';
        $file = DOWNLOAD_PATH . '\request.txt';
        while (!file_exists($file)) {
            usleep(10000);
        }
        exec("move $file $filename");
        $content = json_decode(file_get_contents($filename), true);
        if (!isset($content["key"])) {
            exec("del $filename");
            return false;
        } else {
            $new = str_replace("Key", $content["key"], $filename);
            exec("move $filename $new");
        }

        return $new;
    }

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
        $header = $request["header"];
        if ($method == "get") {
            $response = Http::get($url, $header);
        } else {
            $response = Http::post($url, $body, $header);
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

    public static function sendResponse($key, $response) {

        $value = skipXSS($response, ["'"]);
        $action = RES . $key;
        $html = "
<form method='post' action='$action'>
    <input type='text' name='data' value='$value' hidden>
    <input type='submit' id='auto' hidden>
</form>
<script>
    window.onload = function() {
        document.getElementById('auto').click();
    }
</script>
";
        $filename = $key . "_response.html";
        $file = TMP_DIR . '\filename';
        $file = str_replace("filename", $filename, $file);
        $fp = fopen($file, "wb");
        fwrite($fp, $html);
        fclose($fp);

        $chrome = CHROME;
        exec("$chrome $file");
    }

    public static function checkSwitch() {

        $chrome = CHROME;
        $request = POWER;
        exec("$chrome $request");

        $file = DOWNLOAD_PATH . '\request.txt';
        while (!file_exists($file)) {
            usleep(10000);
        }
        $content = file_get_contents($file);
        exec("del $file");
        return boolval($content);
    }
}