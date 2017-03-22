<?php

use Symfony\Component\Yaml\Yaml;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\AssetServiceProvider;

const ROOT_DIR = __DIR__ . '/../';

$parameters = Yaml::parse(file_get_contents(__DIR__ . '/parameters.yml'))['parameters'];

$app->register(new ServiceControllerServiceProvider());
$app->register(new SessionServiceProvider());

$app->register(new MonologServiceProvider(), [
    'monolog.logfile' => ROOT_DIR . 'var/logs/dev.log'
]);

$app->register(new TwigServiceProvider(), [
    'twig.path' => ROOT_DIR . 'src/App/Resources/views',
    'twig.options' => [
        'cache' => ROOT_DIR . 'var/cache/twig',
        'debug' => true,
        'auto_reload' => true
    ]
]);

$app->register(new Silex\Provider\AssetServiceProvider(), [
    'assets.version' => 'v1'
]);
