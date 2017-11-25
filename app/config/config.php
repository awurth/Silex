<?php

use App\Entity\User;
use Symfony\Component\Dotenv\Dotenv;

(new Dotenv())->load(__DIR__.'/../../.env');

require __DIR__ . '/security.php';

$app['cache_dir'] = $app['root_dir'] . '/var/cache/' . $app['environment'];

$app['monolog.logfile'] = $app['root_dir'] . '/var/logs/' . $app['environment'] . '.log';

$app['db.options'] = [
    'driver'   => getenv('DATABASE_DRIVER'),
    'host'     => getenv('DATABASE_HOST'),
    'user'     => getenv('DATABASE_USER'),
    'password' => getenv('DATABASE_PASSWORD'),
    'dbname'   => getenv('DATABASE_NAME')
];

$app['translator.cache_dir'] = $app['cache_dir'] . '/translations';

$app['assets.version'] = 'v1';

$app['twig.path'] = [
    $app['root_dir'] . '/templates'
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
        ]
    ]
];

$app['swiftmailer.options'] = [
    'host'       => getenv('MAILER_HOST'),
    'port'       => getenv('MAILER_PORT'),
    'username'   => getenv('MAILER_USER'),
    'password'   => getenv('MAILER_PASSWORD'),
    'encryption' => getenv('MAILER_ENCRYPTION'),
    'auth_mode'  => getenv('MAILER_AUTH_MODE')
];

// https://github.com/awurth/SilexUserBundle
$app['silex_user.options'] = [
    'object_manager' => 'orm.em',
    'user_class'     => User::class,
    'firewall_name'  => 'main',
    'use_templates'  => false,
    'use_authentication_listener'          => false,
    'registration.confirmation.enabled'    => false,
    'registration.confirmation.from_email' => getenv('MAILER_USER')
];
