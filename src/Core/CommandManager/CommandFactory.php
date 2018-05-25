<?php

namespace IntegralCalculator\Core\CommandManager;

use IntegralCalculator\Configs\MainConfigs;
use IntegralCalculator\Core\Model\IFactory;

class CommandFactory implements IFactory
{
    public function create(array $params)
    {
        $commandClass = MainConfigs::getInstance()->getCommandClassName(
            $params['alias'],
            $params['version']
        );

        $command = new $commandClass;
        if (!$command->validate($params['input'])) {
            throw new \Exception('Invalid params');
        }
        $command->set($params['input']);

        return $command;
    }
}