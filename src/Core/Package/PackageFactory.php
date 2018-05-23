<?php

namespace IntegralCalculator\Core\Package;

use IntegralCalculator\Core\Model\IFactory;
use IntegralCalculator\Core\Package\Package;

class PackageFactory implements IFactory
{
    private function isValidFunction($func)
    {
        //todo
        return true;
    }

    public function create(array $data)
    {
        if (!isset($data['func']) || !$this->isValidFunction($data['func'])) {
            throw new \Exception('Invalid func');
        }

        if (!isset($data['surface']) || !$this->isValidFunction($data['surface'])) {
            throw new \Exception('Invalid surface');
        }

        if (!isset($data['xMin']) || !isset($data['xMax'])) {
            throw new \Exception('Invalid xMin or xMax');
        }

        $xMin = intval($data['xMin']);
        $xMax = intval($data['xMax']);

        if ($xMin != $data['xMin'] || $xMax != $data['xMax'] || $xMin >= $xMax) {
            throw new \Exception('Invalid xMin or xMax');
        }

        return new Package(
            $data['func'],
            $data['surface'],
            $xMin,
            $xMax
        );
    }
}
