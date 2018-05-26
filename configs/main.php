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

    private const PRODUCTION_MODE = 'PRODUCTION';
    private const DEVELOP_MODE    = 'DEVELOP';

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
            [
                'id'   => 1,
                'name' => 'Rectangle method',
                'class_name' => 'IntegralCalculator\Command\Model\Methods\RectangleMethod',
            ],
        ],

        'mode' => self::PRODUCTION_MODE
    ];

    public function getCommandClassName(string $alias, int $version)
    {
        foreach ($this->configs['commands'] as $command) {
            if ($command['alias'] == $alias && $command['version'] == $version) {
                return $command['class_name'];
            }
        }

        return false;
    }

    public function getMethodMetadata(int $id)
    {
        foreach ($this->configs['methods'] as $method) {
            if ($method['id'] == (string)$id ) {
                return $method;
            }
        }

        return false;
    }

    public function isProductionMode () {
        return $this->configs['mode'] === self::PRODUCTION_MODE;
    }
}