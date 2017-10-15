<?php

use Silex\Provider as SP;

require __DIR__ . '/providers.php';

$app->register(new SP\VarDumperServiceProvider());
$app->register(new SP\WebProfilerServiceProvider());
