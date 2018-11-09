<?php

namespace app\components;

spl_autoload_register(__NAMESPACE__ . '\\autoload');

function autoload($class) {
    
    $class = ltrim($class, '\\');
    if (strpos($class, 'app') !== 0) {
        return;
    }

    $class = str_replace('app', '', $class);
    
    $path = ROOT . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    
    require_once($path);
}
