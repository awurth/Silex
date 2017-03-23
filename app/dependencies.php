<?php

use Symfony\Component\Yaml\Yaml;
use Silex\Provider\VarDumperServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Saxulum\DoctrineOrmManagerRegistry\Provider\DoctrineOrmManagerRegistryProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\AssetServiceProvider;

const ROOT_DIR = __DIR__ . '/../';

$parameters = Yaml::parse(file_get_contents(__DIR__ . '/parameters.yml'))['parameters'];

$app->register(new VarDumperServiceProvider());

$app->register(new MonologServiceProvider(), [
    'monolog.logfile' => ROOT_DIR . 'var/logs/dev.log'
]);

$app->register(new ServiceControllerServiceProvider());

$app->register(new SessionServiceProvider());

$app->register(new DoctrineServiceProvider(), [
    'db.options' => $parameters
]);

$app->register(new DoctrineOrmServiceProvider(), [
    'orm.em.options' => [
        'mappings' => [
            [
                'type' => 'annotation',
                'namespace' => 'App\Entity',
                'path' => ROOT_DIR . 'src/App/Entity',
                'use_simple_annotation_reader' => false
            ]
        ]
    ]
]);

$app->register(new DoctrineOrmManagerRegistryProvider());

$app->register(new TwigServiceProvider(), [
    'twig.path' => ROOT_DIR . 'src/App/Resources/views',
    'twig.options' => [
        'cache' => ROOT_DIR . 'var/cache/twig',
        'debug' => true,
        'auto_reload' => true
    ]
]);

$app->register(new AssetServiceProvider(), [
    'assets.version' => 'v1'
]);
