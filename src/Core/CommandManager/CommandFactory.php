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
        $command->validate($params['input']);
        $command->set($params['input']);

        return $command;
    }
}