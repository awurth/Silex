<?php

use Silex\Provider\WebProfilerServiceProvider;
use Silex\Provider\VarDumperServiceProvider;

require __DIR__ . '/providers.php';

$app->register(new VarDumperServiceProvider());
$app->register(new WebProfilerServiceProvider());
