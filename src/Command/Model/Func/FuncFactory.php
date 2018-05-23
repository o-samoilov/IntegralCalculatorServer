<?php

namespace IntegralCalculator\Command\Model\Func;

use IntegralCalculator\Core\Model\IFactory;

class FuncFactory implements IFactory
{
    public function create(array $data)
    {
        //todo заменить все как в js
        return new Func($data['func'], $data['vars']);
    }
}