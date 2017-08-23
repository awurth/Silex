<?php

use Silex\Application;
use Symfony\Component\Debug\Debug;

require __DIR__ . '/../../vendor/autoload.php';

Debug::enable();

$app = new Application();

$app['debug'] = true;
$app['root_dir'] = dirname(__DIR__, 2);
$app['environment'] = 'dev';

require __DIR__ . '/../../app/providers_dev.php';

require __DIR__ . '/../../app/config/config_dev.php';

require __DIR__ . '/../../app/controllers.php';

require __DIR__ . '/../../app/routing.php';

$app->run();
