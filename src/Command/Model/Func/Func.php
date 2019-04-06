<?php

namespace IntegralCalculator\Command\Model\Func;

class Func
{
    private $func;
    private $vars;

    /// ########################################

    public function __construct(string $func, array $vars)
    {
        $this->func = $func;
        $this->vars = $vars;
    }

    // ########################################

    public function getValueFunc(array $nums)
    {
        if (count($this->vars) != count($nums)) {
            return;
        }

        $evalStr = $this->func;
        foreach ($nums as $var => $num) {
            //todo проверить есть ли $var в $this->vars
            //если нет ошибка

            $evalStr = str_replace([$var], $num, $evalStr);
        }

        $f = 0;
        eval('$f = ' . $evalStr . ';');

        return $f;
    }

    // ########################################

    public function getString()
    {
        return $this->func;
    }

    /// ########################################
}
