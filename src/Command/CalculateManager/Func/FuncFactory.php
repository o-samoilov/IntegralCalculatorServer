<?php

namespace IntegralCalculator\Core;

use IntegralCalculator\Core\Model\IFactory;

class FuncFactory implements IFactory
{
    public function create(array $data)
    {
        return new Func();
    }
}