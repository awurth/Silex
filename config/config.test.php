<?php

require __DIR__ . '/config.dev.php';

$app['db.options'] = [
    'driver' => 'pdo_sqlite',
    'path'   => $app->getCacheDir().'/test.db'
];

$app['session.test'] = true;

unset($app['exception_handler']);
