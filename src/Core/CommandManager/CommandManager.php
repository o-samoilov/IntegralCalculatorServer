<?php

namespace IntegralCalculator\Core\CommandManager;

class CommandManager
{
    private $command;
    private $version;
    private $params;

    public function __construct(string $command, int $version, array $params)
    {
        $this->command = $command;
        $this->version = $version;
        $this->params  = $params;
    }

    public function createCommand() {
        $command = 1;
    }
}