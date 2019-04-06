<?php

namespace IntegralCalculator;

require '../configs/main.php';

class Bootstrap
{
    // ########################################

    public function __construct() {}

    // ########################################

    public function process()
    {
        header('Access-Control-Allow-Origin: *');

        ob_start();
        error_reporting(E_ERROR);

        register_shutdown_function([$this, 'fatalHandler']);

        spl_autoload_register(function ($class_name) {
            $classPathArray = explode('\\', $class_name);
            unset($classPathArray[0]);
            $classPath = implode('\\', $classPathArray);

            $path = __DIR__ . '\\' . $classPath . '.php';
            include $path;
        });

        function fatal_handler()
        {
            echo json_encode(["error" => "Invalid request"]);
        }
    }

    // ########################################

    public function fatalHandler()
    {
        $error = error_get_last();

        if (!is_null($error) && $error['type'] != E_WARNING) {
            ob_clean();
            echo json_encode(["error" => "Invalid request"]);
        }
    }

    // ########################################
}

