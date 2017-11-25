<?php

use Silex\Application;
use Symfony\Component\Debug\Debug;
use Symfony\Component\Dotenv\Dotenv;

require __DIR__.'/../vendor/autoload.php';

if (!isset($_SERVER['APP_ENV'])) {
    if (!class_exists(Dotenv::class)) {
        throw new \RuntimeException('APP_ENV environment variable is not defined. You need to define environment variables for configuration or add "symfony/dotenv" as a Composer dependency to load variables from a .env file.');
    }
    (new Dotenv())->load(__DIR__.'/../.env');
}

if ($debug = $_SERVER['APP_DEBUG'] ?? ('prod' !== ($_SERVER['APP_ENV'] ?? 'dev'))) {
    Debug::enable();
}

$app = new Application();

$app['debug'] = $debug;
$app['env'] = $_SERVER['APP_ENV'] ?? 'dev';
$app['root_dir'] = dirname(__DIR__);

require __DIR__.'/../config/providers.php';

if (file_exists(__DIR__.'/../config/config.'.$app['env'].'.php')) {
    require __DIR__.'/../config/config.'.$app['env'].'.php';
} else {
    require __DIR__.'/../config/config.php';
}

require __DIR__.'/../config/controllers.php';

require __DIR__.'/../config/routes.php';

require __DIR__.'/../config/handlers.php';

$app->run();
