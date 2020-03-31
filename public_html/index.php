<?php

use Phalcon\Mvc\Application;

error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');
// Read the configuration
$config = require_once APP_PATH . '/config/config.php';


date_default_timezone_set('UTC');
include APP_PATH . '/config/loader.php';
include APP_PATH . '/config/services.php';

$application = new Application($di);
try {
    $response = $application->handle();
    $response->send();
} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
