<?php

namespace IntegralCalculator\Core\Model;

abstract class AbstractCommand
{
    public function validate(array $input)
    {
        return true;
    }

    abstract function process();

    abstract function set(array $input);
}