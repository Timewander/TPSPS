<?php

define("TMP_DIR", ROOT_DIR . '\..\tmp');
define("POWER", "http://proxy-sky.richemont.d1m.cn/power");
define("SWITCH_STATUS", false);
// choose log the request & response to disk or not
// define("ACTION", "dealRequest");
define("ACTION", "setRequest");
define("REQUEST", "http://proxy-sky.richemont.d1m.cn/request");
define("RESPONSE", "http://proxy-sky.richemont.d1m.cn/response");
define("DEAL", "http://localhost/client.php?action=" . ACTION);
