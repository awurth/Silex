<?php

use AWurth\SilexUser\Provider\SilexUserServiceProvider;
use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Saxulum\DoctrineOrmManagerRegistry\Provider\DoctrineOrmManagerRegistryProvider;
use Silex\Provider\AssetServiceProvider;
use Silex\Provider\CsrfServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Silex\Provider\LocaleServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\SecurityServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\SwiftmailerServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\ValidatorServiceProvider;

$app->register(new MonologServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new SessionServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new FormServiceProvider());
$app->register(new CsrfServiceProvider());
$app->register(new LocaleServiceProvider());
$app->register(new TranslationServiceProvider());
$app->register(new DoctrineServiceProvider());
$app->register(new DoctrineOrmServiceProvider());
$app->register(new DoctrineOrmManagerRegistryProvider());
$app->register(new HttpFragmentServiceProvider());
$app->register(new SwiftmailerServiceProvider());
$app->register(new SecurityServiceProvider());
$app->register(new AssetServiceProvider());
$app->register(new TwigServiceProvider());

// https://github.com/awurth/silex-user
$app->register(new SilexUserServiceProvider());
