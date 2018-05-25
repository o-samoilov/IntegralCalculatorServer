<?php

namespace IntegralCalculator\Command;

use IntegralCalculator\Command\Model\Methods\MethodFactory;
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
        if (!isset($input['func'])) {
            throw new \Exception('Invalid func');
        }

        if (!isset($input['surface'])) {
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
    }

    public function process()
    {
        $integralSum = [
            'integral_sum' => []
        ];

        foreach ($this->methods as $methodId) {
            $method = (new MethodFactory())->create([
                'method_id' => $methodId,
                'func'      => $this->func,
                'surface'   => $this->surface,
                'xmin'      => $this->xMin,
                'xmax'      => $this->xMax,
            ]);

            $method->process();

            $integralSum['integral_sum'][] = [
                'id'    => $method->getId(),
                'name'  => $method->getName(),
                'value' => $method->getOutput(),
            ];
        }

        $metadata = [
            'metadata' => [
                [
                    'id'    => 'func',
                    'name'  => 'Function',
                    'value' => $this->func->getString(),
                ],
                [
                    'id'    => 'surface',
                    'name'  => 'Surface',
                    'value' => $this->surface->getString(),
                ],
                [
                    'id'    => 'xmin',
                    'name'  => 'xmin',
                    'value' => $this->xMin,
                ],
                [
                    'id'    => 'xmax',
                    'name'  => 'xmax',
                    'value' => $this->xMax,
                ],
            ],
        ];

        $this->output = array_merge($metadata, $integralSum);
    }
}