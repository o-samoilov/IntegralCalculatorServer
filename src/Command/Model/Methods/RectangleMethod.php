<?php

namespace IntegralCalculator\Command\Model\Methods;

use IntegralCalculator\Command\Model\Func\Func;

class RectangleMethod extends Method
{
    public function __construct(
        Func $func,
        Func $surface,
        array $intervals,
        int $id,
        string $name
        )
    {
        $this->func      = $func;
        $this->surface   = $surface;
        $this->intervals = $intervals;
        $this->id        = $id;
        $this->name      = $name;
    }

    public function process()
    {
        foreach ($this->intervals as $interval) {

            $sum = 0;

            for ($x = $interval['start']; $x <= $interval['end']; $x += self::STEP) {

                $x1 = $x;
                $y1 = $this->func->getValueFunc(['x' => $x1]);

                $x2 = $x + self::STEP;
                $y2 = $this->func->getValueFunc(['x' => $x2]);

                $z = $this->surface->getValueFunc(['x' => ($x1 + $x2) / 2, 'y' => ($y1 + $y2) / 2]);

                $sum += sqrt(pow($x2 - $x1, 2) + pow($y2 - $y1, 2)) * $z;
            }

            $this->sum += $sum;

        }
    }

}