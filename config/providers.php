<?php

return [
    Silex\Provider\MonologServiceProvider::class           => ['all' => true],
    Silex\Provider\ServiceControllerServiceProvider::class => ['all' => true],
    Silex\Provider\SessionServiceProvider::class           => ['all' => true],
    Silex\Provider\ValidatorServiceProvider::class         => ['all' => true],
    Silex\Provider\FormServiceProvider::class              => ['all' => true],
    Silex\Provider\CsrfServiceProvider::class              => ['all' => true],
    Silex\Provider\LocaleServiceProvider::class            => ['all' => true],
    Silex\Provider\TranslationServiceProvider::class       => ['all' => true],
    Silex\Provider\DoctrineServiceProvider::class          => ['all' => true],
    Silex\Provider\HttpFragmentServiceProvider::class      => ['all' => true],
    Silex\Provider\SwiftmailerServiceProvider::class       => ['all' => true],
    Silex\Provider\SecurityServiceProvider::class          => ['all' => true],
    Silex\Provider\AssetServiceProvider::class             => ['all' => true],
    Silex\Provider\TwigServiceProvider::class              => ['all' => true],

    Silex\Provider\VarDumperServiceProvider::class   => ['dev' => true],
    Silex\Provider\WebProfilerServiceProvider::class => ['dev' => true],

    Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider::class                        => ['all' => true],
    Saxulum\DoctrineOrmManagerRegistry\Provider\DoctrineOrmManagerRegistryProvider::class => ['all' => true],

    // https://github.com/awurth/SilexUserBundle
    AWurth\Silex\User\Provider\UserServiceProvider::class => ['all' => true]
];
