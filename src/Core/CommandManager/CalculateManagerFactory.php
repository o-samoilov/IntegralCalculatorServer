<?php

namespace IntegralCalculator\Core\CalculateManager;

use IntegralCalculator\Core\Model\IFactory;

class CalculateManagerFactory implements IFactory
{
    public function __construct()
    {

    }

    public function create(array $data) {
        return new CalculateManager();
    }
}