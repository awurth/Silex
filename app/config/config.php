<?php

use Security\Entity\User;
use Symfony\Component\Yaml\Yaml;

const ROOT_DIR = __DIR__ . '/../../';

$parameters = Yaml::parse(file_get_contents(__DIR__ . '/parameters.yml'))['parameters'];

require __DIR__ . '/security.php';

$app['monolog.logfile'] = ROOT_DIR . 'var/logs/' . $app['environment'] . '.log';

$app['db.options'] = [
    'driver' => $parameters['database_driver'],
    'host' => $parameters['database_host'],
    'user' => $parameters['database_user'],
    'password' => $parameters['database_password'],
    'dbname' => $parameters['database_name']
];

$app['translator.cache_dir'] = ROOT_DIR . 'var/cache/' . $app['environment'] . '/translations';

$app['assets.version'] = 'v1';

$app['twig.path'] = [
    ROOT_DIR . 'src/App/Resources/views',
    ROOT_DIR . 'src/Security/Resources/views'
];

$app['twig.options'] = [
    'cache' => ROOT_DIR . 'var/cache/' . $app['environment'] . '/twig',
    'debug' => true,
    'auto_reload' => true
];

$app['orm.proxies_dir'] = ROOT_DIR . 'var/cache/' . $app['environment'] . '/doctrine/orm/proxies';
$app['orm.em.options'] = [
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
];

$app['swiftmailer.options'] = [
    'host' => $parameters['mailer_host'],
    'port' => $parameters['mailer_port'],
    'username' => $parameters['mailer_user'],
    'password' => $parameters['mailer_password'],
    'encryption' => $parameters['mailer_encryption'],
    'auth_mode' => $parameters['mailer_auth_mode']
];

$app['silex_user.options'] = [
    'user_class' => User::class,
    'firewall_name' => 'main',
    'use_templates' => false,
    'use_authentication_listener' => false,
    'registration.confirmation.enabled' => false,
    'registration.confirmation.from_email' => $parameters['mailer_user']
];
