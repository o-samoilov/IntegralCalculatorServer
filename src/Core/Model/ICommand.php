<?php

namespace IntegralCalculator\Core\Model;

interface ICommand
{
    public function process(array $params);
}