<?php

namespace IntegralCalculator\Core\FuncFactory;

use IntegralCalculator\Core\Model\IFactory;
use IntegralCalculator\Core\Func\Func;

class FuncFactory implements IFactory
{
    public function create(array $data)
    {
        return new Func();
    }
}