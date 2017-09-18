<?php

require_once "init.php";

$action = Request::get("action");
if (!is_null($action)) {
    switch ($action) {
        case "setRequest" :
            $content = Request::checkArray("data");
            $file = Kernel::setRequest($content);
            list($key, $response) = Kernel::dealRequest($file);
            Kernel::logResponse($key, $response);
            break;
        case "dealRequest" :
            $content = Request::checkArray("data");
            list($key, $response) = Kernel::dealRequest(null, $content);
            break;
        default :
            die;
    }
    Response::build([
        "key" => $key,
        "data" => $response
    ], 200);
}

$switch = POWER;
$switch_status = boolval(SWITCH_STATUS) ? "true" : "false";
$request = REQUEST;
$response = RESPONSE;
$deal = DEAL;

$script = "<title>TPSPS</title>
<meta name='author' content='Timewander, gf-fly@163.com'>
<link rel='shortcut icon' type='image/ico' href='/sky.ico'>
<script src='jquery-3.2.1.min.js'></script>
<script>
    var status = 'on';
    var refresh_times = 100;
    function checkSwitch() {
        $.get('$switch', function(data) {
            status = data;
        });
    }
    function refresh() {
        if ($switch_status) {
            checkSwitch();
        }
        if (refresh_times -- <= 1) {
            console.clear();
            window.location.href = '';
        } else if (status == 'on') {
            setTimeout('getRequest();', 100);
        }
    }
    function getRequest() {
        $.ajax({
            'url' : '$request',
            'type' : 'GET',
            'timeout' : 10000,
            'success' : function(data) {
                dealRequest(data, false);
            },
            'error' : function() {
                refresh();
            }
        });
    }
    function dealRequest(data, need_refresh) {
        $.ajax({
            'url' : '$deal',
            'type' : 'POST',
            'timeout' : 20000,
            'data' : {
                data : data
            },
            'success' : function(data) {
                setResponse(data);
            },
            'error' : function() {
                if (need_refresh) {
                    refresh();
                } else {
                    dealRequest(data, true);
                }
            }
        });
    }
    function setResponse(data) {
        $.ajax({
            'url' : '$response',
            'type' : 'POST',
            'timeout' : 30000,
            'data' : data,
            'complete' : function() {
                refresh();
            }
        });
    }
    $(function() {
        getRequest();
        window.resizeTo(400, 80);
    });
</script>
<style>
body {
    background-color: #38B0DE;
}
.client {
    margin: 0 auto;
    width: 200px;
    padding: 10px 0;
    text-align: center;
    color: white;
}
</style>
<div class='client'>Welcome to TPSPS</div>";
print $script;