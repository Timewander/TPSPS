<?php

define("TMP_DIR", ROOT_DIR . '\..\tmp');
define("POWER", "http://weboutique-sky.richemont.d1m.cn/switch");
define("SWITCH_STATUS", false);
// choose log the request & response to disk or not
// define("ACTION", "dealRequest");
define("ACTION", "setRequest");
define("REQUEST", "http://weboutique-sky.richemont.d1m.cn/request");
define("RESPONSE", "http://weboutique-sky.richemont.d1m.cn/response");
define("DEAL", "http://localhost/client.php?action=" . ACTION);
