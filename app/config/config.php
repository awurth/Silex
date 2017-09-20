<?php

use Security\Entity\User;
use Symfony\Component\Yaml\Yaml;

$parameters = Yaml::parse(file_get_contents(__DIR__ . '/parameters.yml'))['parameters'];

require __DIR__ . '/security.php';

$app['cache_dir'] = $app['root_dir'] . '/var/cache/' . $app['environment'];

$app['monolog.logfile'] = $app['root_dir'] . '/var/logs/' . $app['environment'] . '.log';

$app['db.options'] = [
    'driver'   => $parameters['database_driver'],
    'host'     => $parameters['database_host'],
    'user'     => $parameters['database_user'],
    'password' => $parameters['database_password'],
    'dbname'   => $parameters['database_name']
];

$app['translator.cache_dir'] = $app['cache_dir'] . '/translations';

$app['assets.version'] = 'v1';

$app['twig.path'] = [
    $app['root_dir'] . '/src/App/Resources/views',
    $app['root_dir'] . '/src/Security/Resources/views'
];

$app['twig.options'] = [
    'cache' => $app['cache_dir'] . '/twig'
];

$app['orm.proxies_dir'] = $app['cache_dir'] . '/doctrine/orm/proxies';
$app['orm.em.options'] = [
    'mappings' => [
        [
            'type'      => 'annotation',
            'namespace' => 'App\Entity',
            'path'      => $app['root_dir'] . '/src/App/Entity',
            'use_simple_annotation_reader' => false
        ], [
            'type'      => 'annotation',
            'namespace' => 'Security\Entity',
            'path'      => $app['root_dir'] . '/src/Security/Entity',
            'use_simple_annotation_reader' => false
        ]
    ]
];

$app['swiftmailer.options'] = [
    'host'       => $parameters['mailer_host'],
    'port'       => $parameters['mailer_port'],
    'username'   => $parameters['mailer_user'],
    'password'   => $parameters['mailer_password'],
    'encryption' => $parameters['mailer_encryption'],
    'auth_mode'  => $parameters['mailer_auth_mode']
];

// https://github.com/awurth/silex-user
$app['silex_user.options'] = [
    'object_manager' => 'orm.em',
    'user_class'     => User::class,
    'firewall_name'  => 'main',
    'use_templates'  => false,
    'use_authentication_listener'          => false,
    'registration.confirmation.enabled'    => false,
    'registration.confirmation.from_email' => $parameters['mailer_user']
];
