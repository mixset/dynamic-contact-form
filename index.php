<?php
session_start();

header('Content-Type: text/html; charset=UTF-8');

error_reporting(E_ALL);

ini_set('display_error', 1);


// Before any action, check whether PHP is higher that 5.4.0
if (version_compare(PHP_VERSION, '5.4.0') <= 0) {
    error_log('PHP 5.4.0 version is required. System cannot work properly.');
    exit;
}

spl_autoload_register(function ($className) {

    # Usually I would just concatenate directly to $file variable below
    # this is just for easy viewing on Stack Overflow)
    $ds = DIRECTORY_SEPARATOR;
    $dir = __DIR__;

    // replace namespace separator with directory separator (prolly not required)
    $className = lcfirst(str_replace('\\', $ds, $className));

    // get full name of file containing the required class
    $file = "{$dir}{$ds}src/{$className}.php";

    // get file if it is readable
    if (is_readable($file)) require_once $file;
});

require __DIR__ . '/vendor/autoload.php';

require 'src/template/index.php';
