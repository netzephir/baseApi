<?php
require_once __DIR__.'/config.php';
if(ENV_DEV_MODE)
{
    error_reporting(E_ALL);
    ini_set('display_errors',1);
}
require_once __DIR__.'/autoLoader.php';

$request = new \Core\Request();

$router = new \Core\Router($request);
$app = new \Core\App($router);

$app->run();