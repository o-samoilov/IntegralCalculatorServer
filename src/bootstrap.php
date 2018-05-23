<?php

namespace IntegralCalculator;

require '../configs/main.php';

use IntegralCalculator\Configs\MainConfigs;

class Bootstrap
{
    public function __construct() {

    }

    public function process()
    {
        spl_autoload_register(function ($class_name) {
            $classPathArray = explode('\\', $class_name);
            unset($classPathArray[0]);
            $classPath = implode('\\', $classPathArray);

            $path = __DIR__ . '\\' . $classPath  . '.php';
            include $path;
        });
    }
}