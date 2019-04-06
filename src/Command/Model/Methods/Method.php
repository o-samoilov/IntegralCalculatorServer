<?php

namespace IntegralCalculator\Command\Model\Methods;

abstract class Method
{
    public const STEP = 0.001;

    public $func;
    public $surface;
    public $intervals;
    public $id;
    public $name;

    public $sum = 0;

    // ########################################

    abstract function process();

    // ########################################

    public function getOutput()
    {
        return round($this->sum, 3);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getId()
    {
        return $this->id;
    }

    // ########################################
}
