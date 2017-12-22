<?php 

mb_internal_encoding("UTF-8");

require '../vendor/autoload.php';

require_once '../generated-conf/config.php';



ini_set("display_errors", 1);
error_reporting(-1);



$config = require '../application/config.php';

$application = new \App\core\Application($config);
$application->run();
