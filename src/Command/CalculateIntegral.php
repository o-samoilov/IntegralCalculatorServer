<?php

namespace IntegralCalculator\Command;

use IntegralCalculator\Command\Model\Methods\MethodFactory;
use IntegralCalculator\Command\Model\Func\FuncFactory;
use IntegralCalculator\Configs\MainConfigs;
use IntegralCalculator\Core\Model\AbstractCommand;

class CalculateIntegral extends AbstractCommand
{
    private const STEP     = 0.0001;
    private const EPS      = 0.00001;
    private const INFINITY = 100000;//100k

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

        $xMin = floatval($input['xMin']);
        $xMax = floatval($input['xMax']);

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
        $this->xMin    = floatval($input['xMin']);
        $this->xMax    = floatval($input['xMax']);
        $this->methods = $input['methods'];
    }

    public function process()
    {

        $intervals = $this->getAllowedIntervals();
        if (is_infinite($intervals)) {
            $this->output = array_merge($this->getMetadata(), $this->getIntegralSumWithStaticValue('Infinity'));
            return;
        } elseif (count($intervals) == 0) {
            $this->output = array_merge($this->getMetadata(), $this->getIntegralSumWithStaticValue('0'));
            return;
        }

        $this->output = array_merge($this->getMetadata($intervals), $this->getIntegralSum($intervals));
    }

    /*
     * return array|INF
    */
    private function getAllowedIntervals()
    {
        $intervals = [];

        $startInterval = $this->xMin;

        for ($x = $this->xMin; $x <= $this->xMax; $x += self::STEP) {

            $y = $this->func->getValueFunc(['x' => $x]);
            $z = $this->surface->getValueFunc(['x' => $x, 'y' => $y]);

            if (abs($y) > self::INFINITY || abs($z) > self::INFINITY) {
                return INF;
            }

            if (is_nan($y) || is_nan($z)) {
                if ($startInterval == $x) {
                    $startInterval = $x + self::STEP;
                    continue;
                }

                $intervals[] = [
                    'start' => $startInterval,
                    'end'   => $x - self::STEP,
                ];

                $startInterval = $x + self::STEP;
                continue;
            }

            if ($x >= $this->xMax - self::EPS) {
                $intervals[] = [
                    'start' => $startInterval,
                    'end'   => $x,
                ];
            }
        }

        return $intervals;
    }

    private function getMetadata($intervals = []) {
        $intervalsOutput = [];

        foreach ($intervals as $interval) {
            $intervalsOutput[] = [
                'start' => round($interval['start'], 2),
                'end'   => round($interval['end'], 2),
            ];
        }

        return [
            'metadata' => [
                [
                    'id'    => 'func',
                    'name'  => 'L(x)',
                    'value' => $this->func->getString(),
                ],
                [
                    'id'    => 'surface',
                    'name'  => 'f(x, y)',
                    'value' => $this->surface->getString(),
                ],
                [
                    'id'    => 'intervals',
                    'name'  => 'Intervals',
                    'value' => $intervalsOutput,
                ],
            ],
        ];
    }

    private function getIntegralSum(array $intervals)
    {
        $integralSum = [
            'integral_sum' => []
        ];

        foreach ($this->methods as $methodId) {

            $method = (new MethodFactory())->create([
                'method_id' => $methodId,
                'func'      => $this->func,
                'surface'   => $this->surface,
                'intervals' => $intervals
            ]);

            $method->process();

            $integralSum['integral_sum'][] = [
                'id'    => $method->getId(),
                'name'  => $method->getName(),
                'value' => $method->getOutput(),
            ];
        }

        return $integralSum;
    }

    private function getIntegralSumWithStaticValue(string $value)
    {
        $integralSum = [
            'integral_sum' => []
        ];

        foreach ($this->methods as $methodId) {

            $methodMetadata = MainConfigs::getInstance()->getMethodMetadata($methodId);

            $integralSum['integral_sum'][] = [
                'id'    => $methodMetadata['id'],
                'name'  => $methodMetadata['name'],
                'value' => $value,
            ];
        }

        return $integralSum;
    }
}