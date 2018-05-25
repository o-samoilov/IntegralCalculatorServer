<?php

namespace IntegralCalculator\Command\Model\Func;

use IntegralCalculator\Core\Model\IFactory;

class FuncFactory implements IFactory
{
    private $validExpressions = [
        '(',
        ')',

        ' ',
        ',',
        '.',

        '+',
        '-',
        '*',
        '/',

        'SIN',
        'COS',
        'TG',
        'POW',

        '1',
        '2',
        '3',
        '4',
        '5',
        '6',
        '7',
        '8',
        '9',
        '0',
    ];
    private $vars;

    private $replaceExpressions = [
        'SIN' => 'sin',
        'COS' => 'cos',
        'TG'  => 'tan',
        'POW' => 'pow',
    ];

    public function create(array $data)
    {
        if (!is_array($data['vars']) || count($data['vars']) == 0){
            throw new \Exception('Invalid func');
        }

        $this->vars = $data['vars'];

        if (!$this->isValid($data['func'])) {
            throw new \Exception('Invalid func');
        }

        return new Func($this->getFunc($data['func']), $data['vars']);
    }

    private function isValid(string$func) {
        $func = str_replace(array_merge($this->validExpressions, $this->vars), "", $func);
        return $func == '';
    }

    private function getFunc(string $func) {
        //todo sin(deg2rad(x))

        foreach ($this->replaceExpressions as $oldExpression => $newExpression) {
            $func = str_replace([$oldExpression], $newExpression, $func);
        }

        return $func;
    }
}