<?php

use Silex\Provider\WebProfilerServiceProvider;
use Silex\Provider\VarDumperServiceProvider;

require __DIR__ . '/providers.php';

$app['assets.base_path'] = '..';

$app->register(new VarDumperServiceProvider());

$app->register(new WebProfilerServiceProvider(), [
    'profiler.cache_dir' => ROOT_DIR . 'var/cache/' . $app['environment'] . '/profiler'
]);
