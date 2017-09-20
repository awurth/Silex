<?php

use Silex\Application;

require __DIR__ . '/../vendor/autoload.php';

$app = new Application();

$app['debug'] = true;
$app['root_dir'] = dirname(__DIR__);
$app['environment'] = 'test';

require __DIR__ . '/../app/providers_dev.php';

require __DIR__ . '/../app/config/config_test.php';

require __DIR__ . '/../app/controllers.php';

require __DIR__ . '/../app/routing.php';

return $app;
