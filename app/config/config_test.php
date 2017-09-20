<?php

require __DIR__ . '/config_dev.php';

$app['db.options'] = [
    'driver' => 'pdo_sqlite',
    'path'   => $app['cache_dir'] . '/test.db'
];

$app['session.test'] = true;

unset($app['exception_handler']);
