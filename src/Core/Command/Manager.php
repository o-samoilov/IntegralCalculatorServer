<?php

namespace IntegralCalculator\Core\Command;

class Manager
{
    private $alias;
    private $version;
    private $input;

    // ########################################

    public function __construct(string $alias, int $version, array $input)
    {
        $this->alias   = $alias;
        $this->version = $version;
        $this->input   = $input;
    }

    // ########################################

    public function createCommand()
    {
        $commandFactory = new Factory();
        $command        = $commandFactory->create([
            'alias'   => $this->alias,
            'version' => $this->version,
            'input'   => $this->input,
        ]);

        return $command;
    }

    // ########################################
}
