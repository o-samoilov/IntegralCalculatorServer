<?php

http_response_code(200);

$data = [
    'func' => 'L(x) = POW(x, 3)',
    'surface'  => 'f(x, z) = SIN(x) * z',
    'xmax'     => -5,
    'xmin'     => 2,
    'integral_sum' => [
        'rectangle_method' => 21,
    ]
];

echo json_encode($data);