<?php

namespace IntegralCalculator\Core\CommandManager;

use IntegralCalculator\Core\Model\IFactory;

class CommandManagerFactory implements IFactory
{
    public function __construct()
    {

    }

    public function create(array $data) {
        if (!isset($data['command'])) {
            throw new \Exception('Invalid command');
        }

        if (!isset($data['version'])) {
            throw new \Exception('Invalid version');
        }

        $version = intval($data['version']);
        if ($version != $data['version'] || $version < 0) {
            throw new \Exception('Invalid version');
        }

        if (!isset($data['params']) || !is_array($data['params'])) {
            throw new \Exception('Invalid command');
        }

        return new CommandManager(
            $data['command'],
            $version,
            $data['params']
        );
    }
}