<?php

namespace IntegralCalculator\Core\Model;

abstract class AbstractCommand
{
    // ########################################

    public $output;

    public function validate(array $input)
    {
        return true;
    }

    public function getOutput()
    {
        return $this->output;
    }

    abstract function process();

    abstract function set(array $input);

    // ########################################
}
