<?php

namespace app;
session_start();
define('ROOT', dirname(__FILE__));

require_once(ROOT . '/components/autoload.php');

$router = new components\Router();
$router->run();
