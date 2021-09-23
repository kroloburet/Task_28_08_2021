<?php

/**
 * Project constants & vars
 */
define('HOST', $_SERVER['HTTP_HOST']);
define('URI_PATH', parse_url($_SERVER['REQUEST_URI'])['path']);
define('ROOT_PATH', dirname(__DIR__));
define('APP_PATH', ROOT_PATH . '/app/');
define('CORE_PATH', ROOT_PATH . '/core/');

/**
 * Autoloader
 */
spl_autoload_register(function ($class) {
    // maps for the namespace prefix => path
    $maps = [
        'App\\' => APP_PATH,
        'Core\\' => CORE_PATH,
    ];
    foreach ($maps as $prefix => $path) {
        // does the class use the namespace prefix?
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) !== 0) {
            // no, move to the next registered autoloader
            continue;
        }
        // get the relative class name
        $relative_class = substr($class, $len);
        // replace the namespace prefix with path, replace namespace
        // separators with path separators in the relative class name, append
        // with .php
        $file = $path . str_replace('\\', '/', $relative_class) . '.php';
        // if the file exists, require it
        if (file_exists($file)) {
            require $file;
        }
    }
});
