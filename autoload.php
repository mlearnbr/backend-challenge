<?php

function load($namespace)
{
    $path = __DIR__ . '/' . $namespace . '.php';

    return require_once $path;
}

spl_autoload_register(__NAMESPACE__ . 'load');