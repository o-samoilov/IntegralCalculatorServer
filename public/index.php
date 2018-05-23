<?php

namespace IntegralCalculator;

require '../src/bootstrap.php';
require '../src/app.php';

$bootstrap = new Bootstrap();
$bootstrap->process();

$app = new App();
$app->process();

/*
$data = [
    'metadata' => [
        [
            'id'    => 'func',
            'name'  => 'Function',
            'value' => 'L(x) = POW(x, 3)',
        ],
        [
            'id'    => 'surface',
            'name'  => 'Surface',
            'value' => 'f(x, z) = SIN(x) * z',
        ],
        [
            'id'    => 'xmin',
            'name'  => 'xmin',
            'value' => -5,
        ],
        [
            'id'    => 'xmax',
            'name'  => 'xmax',
            'value' => 5,
        ],
    ],

    'integral_sum' => [
        [
            'id'  => 'metod1213',
            'name' => 'Метод прямоугольников',
            'value'  => 33,
        ],
        [
            'id'  => 'metod1213',
            'name' => 'Метод прямоугольников22',
            'value'  => 123123,
        ],
        [
            'id'  => 'metod1213',
            'name' => 'Метод прямоугольников',
            'value'  => 33,
        ],
        [
            'id'  => 'metod1213',
            'name' => 'Метод прямоугольников22',
            'value'  => 123123,
        ],
    ]
];

echo json_encode($data);*/