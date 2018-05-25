<?php

namespace IntegralCalculator\Command\Model\Methods;

use IntegralCalculator\Command\Model\Func\Func;

class RectangleMethod
{
    private $func;
    private $surface;
    private $xmin;
    private $xmax;
    private $id;
    private $name;

    private $step = 0.01;

    private $sum = null;

    public function __construct(
        Func $func,
        Func $surface,
        int $xmin,
        int $xmax,
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
        //TODO не забыть сделать выколотые точки
        $sum = 0;

        for ($x = $this->xmin; $x <= $this->xmax; $x += $this->step) {

            $x1 = $x;
            $y1 = $this->func->getValueFunc(['x' => $x1]);

            if (is_nan($y1)) {
                $x += $this->step;
                continue;
            }

            $x += $this->step;

            $x2 = $x;
            $y2 = $this->func->getValueFunc(['x' => $x2]);

            if (is_nan($y2)) {
                $x += $this->step;
                continue;
            }

            $z = $this->surface->getValueFunc(['x' => $x1, 'y' => $y1]);
            if (is_nan($z)) {
                $x += $this->step;
                continue;
            }

            $sum += sqrt(pow($x2 - $x1, 2) + pow($y2 - $y1, 2)) * $z;
        }

        $this->sum = $sum;
    }

    public function getOutput() {
        return $this->sum;
    }

    public function getName() {
        return $this->name;
    }

    public function getId() {
        return $this->id;
    }
}