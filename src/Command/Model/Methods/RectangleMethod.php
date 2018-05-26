<?php

namespace IntegralCalculator\Command\Model\Methods;

use IntegralCalculator\Command\Model\Func\Func;

class RectangleMethod
{
    private const STEP = 0.001;

    private $func;
    private $surface;
    private $xmin;
    private $xmax;
    private $id;
    private $name;

    private $sum = 0;

    public function __construct(
        Func $func,
        Func $surface,
        float $xmin,
        float $xmax,
        int $id,
        string $name
        )
    {
        $this->func = $func;
        $this->surface = $surface;
        $this->xmin = $xmin;
        $this->xmax = $xmax;
        $this->id   = $id;
        $this->name = $name;
    }

    public function process()
    {
        $sum = 0;

        for ($x = $this->xmin; $x <= $this->xmax; $x += self::STEP) {

            $x1 = $x;
            $y1 = $this->func->getValueFunc(['x' => $x1]);

            $x2 = $x + self::STEP;
            $y2 = $this->func->getValueFunc(['x' => $x2]);

            $z = $this->surface->getValueFunc(['x' => ($x1 + $x2) / 2, 'y' => ($y1 + $y2) / 2]);

            $sum += sqrt(pow($x2 - $x1, 2) + pow($y2 - $y1, 2)) * $z;
        }

        $this->sum += $sum;
    }

    public function getOutput() {
        return round($this->sum, 3);
    }

    public function getName() {
        return $this->name;
    }

    public function getId() {
        return $this->id;
    }
}