<?php

namespace IntegralCalculator\Command\Model\Func;

class Func
{
    private $func;
    private $vars;

    public function __construct(string $func, array $vars)
    {
        $this->func = $func;
        $this->vars = $vars;
    }

    public function getValueFunc(array $num) {
        if (count($this->vars) != count($num)) {
            return;
        }


        return 1;
    }
}