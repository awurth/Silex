<?php

use AWurth\SilexUser\Provider\SilexUserServiceProvider;
use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Saxulum\DoctrineOrmManagerRegistry\Provider\DoctrineOrmManagerRegistryProvider;
use Security\Entity\User;
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
use Symfony\Component\Yaml\Yaml;

const ROOT_DIR = __DIR__ . '/../';

$parameters = Yaml::parse(file_get_contents(__DIR__ . '/parameters.yml'))['parameters'];

$app->register(new MonologServiceProvider(), [
    'monolog.logfile' => ROOT_DIR . 'var/logs/' . $app['environment'] . '.log'
]);

$app->register(new ServiceControllerServiceProvider());

$app->register(new SessionServiceProvider());

$app->register(new ValidatorServiceProvider());

$app->register(new FormServiceProvider());

$app->register(new CsrfServiceProvider());

$app->register(new LocaleServiceProvider());

$app->register(new TranslationServiceProvider(), [
    'translator.cache_dir' => ROOT_DIR . 'var/cache/' . $app['environment'] . '/translations'
]);

$app->register(new DoctrineServiceProvider(), [
    'db.options' => [
        'driver' => $parameters['database_driver'],
        'host' => $parameters['database_host'],
        'user' => $parameters['database_user'],
        'password' => $parameters['database_password'],
        'dbname' => $parameters['database_name']
    ]
]);

$app->register(new DoctrineOrmServiceProvider(), [
    'orm.proxies_dir' => ROOT_DIR . 'var/cache/' . $app['environment'] . '/doctrine/orm/proxies',
    'orm.em.options' => [
        'mappings' => [
            [
                'type' => 'annotation',
                'namespace' => 'App\Entity',
                'path' => ROOT_DIR . 'src/App/Entity',
                'use_simple_annotation_reader' => false
            ], [
                'type' => 'annotation',
                'namespace' => 'Security\Entity',
                'path' => ROOT_DIR . 'src/Security/Entity',
                'use_simple_annotation_reader' => false
            ]
        ]
    ]
]);

$app->register(new DoctrineOrmManagerRegistryProvider());

$app->register(new HttpFragmentServiceProvider());

$app->register(new SwiftmailerServiceProvider(), [
    'swiftmailer.options' => [
        'host' => $parameters['mailer_host'],
        'port' => $parameters['mailer_port'],
        'username' => $parameters['mailer_user'],
        'password' => $parameters['mailer_password'],
        'encryption' => $parameters['mailer_encryption'],
        'auth_mode' => $parameters['mailer_auth_mode']
    ]
]);

$app->register(new SecurityServiceProvider(), [
    'security.role_hierarchy' => [
        'ROLE_ADMIN' => [
            'ROLE_USER',
            'ROLE_ALLOWED_TO_SWITCH'
        ]
    ],
    'security.firewalls' => [
        'main' => [
            'pattern' => '^/',
            'form' => [
                'login_path' => '/login',
                'check_path' => '/login_check',
                'with_csrf' => true
            ],
            'logout' => [
                'logout_path' => '/logout',
                'invalidate_session' => true
            ],
            'anonymous' => true,
            'users' => function ($app) {
                return $app['silex_user.user_provider.username_email'];
            }
        ]
    ]
]);

$app->register(new AssetServiceProvider(), [
    'assets.version' => 'v1'
]);

$app->register(new TwigServiceProvider(), [
    'twig.path' => [
        ROOT_DIR . 'src/App/Resources/views',
        ROOT_DIR . 'src/Security/Resources/views'
    ],
    'twig.options' => [
        'cache' => ROOT_DIR . 'var/cache/' . $app['environment'] . '/twig',
        'debug' => true,
        'auto_reload' => true
    ]
]);

// https://github.com/awurth/silex-user
$app->register(new SilexUserServiceProvider(), [
    'silex_user.options' => [
        'user_class' => User::class,
        'firewall_name' => 'main',
        'use_templates' => false,
        'use_authentication_listener' => false,
        'registration.confirmation.enabled' => false,
        'registration.confirmation.from_email' => $parameters['mailer_user']
    ]
]);
