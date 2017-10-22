<?php

use AWurth\Silex\User\Provider\UserServiceProvider;
use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Saxulum\DoctrineOrmManagerRegistry\Provider\DoctrineOrmManagerRegistryProvider;
use Silex\Provider as SP;

$app->register(new SP\MonologServiceProvider());
$app->register(new SP\ServiceControllerServiceProvider());
$app->register(new SP\SessionServiceProvider());
$app->register(new SP\ValidatorServiceProvider());
$app->register(new SP\FormServiceProvider());
$app->register(new SP\CsrfServiceProvider());
$app->register(new SP\LocaleServiceProvider());
$app->register(new SP\TranslationServiceProvider());
$app->register(new SP\DoctrineServiceProvider());
$app->register(new SP\HttpFragmentServiceProvider());
$app->register(new SP\SwiftmailerServiceProvider());
$app->register(new SP\SecurityServiceProvider());
$app->register(new SP\AssetServiceProvider());
$app->register(new SP\TwigServiceProvider());

$app->register(new DoctrineOrmServiceProvider());
$app->register(new DoctrineOrmManagerRegistryProvider());

// https://github.com/awurth/silex-user
$app->register(new UserServiceProvider());
