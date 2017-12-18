<?php 
mb_internal_encoding("UTF-8");

require '../vendor/autoload.php';

require_once '../generated-conf/config.php';

include_once('../init/init.php');

ini_set("display_errors", 1);

session_start();

$config = require '../application/config.php';

$application = new \app\core\Application($config);
$application->run();