<?php

namespace IntegralCalculator\Core\Model;

interface ICommand
{
    public function validate(array $params);
    public function process(array $params);
}