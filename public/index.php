<?php
ini_set('display_errors', true);

define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'src' . DIRECTORY_SEPARATOR);
define('ASSETS', DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR);

include_once ROOT . 'vendor/autoload.php';

try {
    $application = new \LSM\Application();
    $application->run();
} catch(Exception $e) {
    header("HTTP/1.0 {$e->getCode()}");
    echo $e->getMessage();
}
