<?php

require __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();

$app['debug'] = true;
$app['root_dir'] = dirname(__DIR__);
$app['environment'] = 'test';

require __DIR__ . '/../app/providers.dev.php';

require __DIR__ . '/../app/config/config.test.php';

require __DIR__ . '/../app/controllers.php';

require __DIR__ . '/../app/routing.php';

return $app;
