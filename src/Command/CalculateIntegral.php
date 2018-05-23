<?php

namespace IntegralCalculator\Command;

use IntegralCalculator\Command\Model\Func\FuncFactory;
use IntegralCalculator\Core\Model\AbstractCommand;

class CalculateIntegral extends AbstractCommand
{
    private $func;
    private $surface;
    private $xMin;
    private $xMax;
    private $methods;

    public function validate(array $input)
    {
        if (!isset($input['func']) || !$this->isValidFunction($input['func'])) {
            throw new \Exception('Invalid func');
        }

        if (!isset($input['surface']) || !$this->isValidFunction($input['surface'])) {
            throw new \Exception('Invalid surface');
        }

        if (!isset($input['xMin']) || !isset($input['xMax'])) {
            throw new \Exception('Invalid xMin or xMax');
        }

        $xMin = intval($input['xMin']);
        $xMax = intval($input['xMax']);

        if ($xMin != $input['xMin'] || $xMax != $input['xMax'] || $xMin >= $xMax) {
            throw new \Exception('Invalid xMin or xMax');
        }

        if (!isset($input['methods']) || !is_array($input['methods'])) {
            throw new \Exception('Invalid methods');
        }

        return true;
    }

    public function set(array $input)
    {
        $funcFactory =  new FuncFactory();

        $this->func    = $funcFactory->create($input['func']);
        $this->surface = $funcFactory->create($input['surface']);
        $this->xMin    = intval($input['xMin']);
        $this->xMax    = intval($input['xMax']);
        $this->methods = $input['methods'];

        $this->func->getValueFunc([1]);
    }

    public function process()
    {
        $a = 1;
        // TODO: Implement process() method.
    }

    private function isValidFunction($func)
    {
        //todo
        return true;
    }
}