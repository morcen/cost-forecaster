<?php
ini_set('display_errors', true);

define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'src' . DIRECTORY_SEPARATOR);
define('ASSETS', DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR);

include_once ROOT . 'vendor/autoload.php';

$application = new \LSM\Application();
$application->run();
