<?php

namespace IntegralCalculator\Core\Command;

use IntegralCalculator\Configs\MainConfigs;
use IntegralCalculator\Core\Model\IFactory;

class Factory implements IFactory
{
    // ########################################

    public function create(array $params)
    {
        $commandClass = MainConfigs::getInstance()->getCommandClassName(
            $params['alias'],
            $params['version']
        );

        /** @var \IntegralCalculator\Core\Model\AbstractCommand $command */
        $command = new $commandClass();
        if (!$command->validate($params['input'])) {
            throw new \Exception('Invalid params');
        }
        $command->setInput($params['input']);

        return $command;
    }

    // ########################################
}
