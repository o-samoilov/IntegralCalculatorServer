<?php

namespace IntegralCalculator\Configs;

class MainConfigs
{
    private static $instance = null;

    private function __clone() {}
    private function __construct() {}

    private $configs = [
        'commands' => [
            [
                'alias'      => 'calculateIntegral',
                'class_name' => 'IntegralCalculator\Command\CalculateIntegral',
                'version'    => 1,
            ],
            //'getMethods' => null,
        ],

        'methods' => [
            'id'   => 1,
            'name' => 'Rectangle method',
            'class_name' => 'Rectangle method',
        ],
    ];

    public static function getInstance()
    {
        if (null === self::$instance)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getCommandClassName(string $alias, int $version)
    {
        foreach ($this->configs['commands'] as $command) {
            if ($command['alias'] == $alias && $command['version'] == $version) {
                return $command['class_name'];
            }
        }

        return false;
    }
}