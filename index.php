<?php

spl_autoload_register(function ($class_name) 
{
    if (DIRECTORY_SEPARATOR != '\\')
    {
        $class_name = str_replace('\\', DIRECTORY_SEPARATOR, $class_name);
    }
    
    $file = $class_name . '.php';
    
    if(file_exists($file)) 
    {
        require_once $file;
    }
});

if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action     = $_GET['action'];
} else {
    $controller = 'contacts';
    $action     = 'index';
}

require_once 'views/layout.php';