<?php

namespace IntegralCalculator\Core\CalculateManager\Methods;

use IntegralCalculator\Core\Model\IFactory;

class MethodFactory implements IFactory
{
    public function __construct()
    {

    }

    public function create(array $data) {
        $idMethod = $data['id'];
    }
}