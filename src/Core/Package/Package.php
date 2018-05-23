<?php

namespace IntegralCalculator\Core\Package;

class Package
{
    private $func;
    private $surface;
    private $xMin;
    private $xMax;

    public function  __construct($func, $surface, $xMin, $xMax)
    {
        $this->func    = $func;
        $this->surface = $surface;
        $this->xMin    = $xMin;
        $this->xMax    = $xMax;
    }

    public function getFunc()
    {
        return $this->func;
    }

    public function getSurface()
    {
        return $this->surface;
    }

    public function getXMin()
    {
        return $this->xMin;
    }

    public function getXMax()
    {
        return $this->xMax;
    }
}
