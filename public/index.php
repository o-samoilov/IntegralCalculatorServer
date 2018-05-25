<?php

namespace IntegralCalculator;

require '../src/bootstrap.php';
require '../src/app.php';

$bootstrap = new Bootstrap();
$bootstrap->process();

$app = new App();
$app->process();