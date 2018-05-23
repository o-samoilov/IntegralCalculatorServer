<?php

namespace IntegralCalculator\Configs;

class MainConfigs
{
    private static $instance = null;

    private function __clone() {}
    private function __construct() {}

    public static function getInstance()
    {
        if (null === self::$instance)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function get()
    {
        return [
            'commands' => [
                [
                    'alias' => 'calculateIntegral',
                    'version' => 1
                ],
                //'getMethods' => null,
            ],

            'methods' => [
                'id'   => 1,
                'name' => 'Rectangle method',
                'class_name' => 'Rectangle method',
            ],
        ];
    }
}