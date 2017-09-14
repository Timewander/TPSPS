<?php

define("TMP_DIR", ROOT_DIR . '\..\tmp');
define("LOG_DIR", ROOT_DIR . '\..\logs');
define("POWER", "http://proxy-sky.richemont.d1m.cn/proxy/power");
define("SWITCH_STATUS", false);
// choose log the request & response to disk or not
// define("ACTION", "dealRequest");
define("ACTION", "setRequest");
define("REQUEST", "http://proxy-sky.richemont.d1m.cn/proxy/request");
define("RESPONSE", "http://proxy-sky.richemont.d1m.cn/proxy/response");
define("DEAL", "http://localhost?action=" . ACTION);
