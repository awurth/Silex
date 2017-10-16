<?php

require __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();

$app['root_dir'] = dirname(__DIR__);
$app['environment'] = 'prod';

require __DIR__ . '/../app/providers.php';

require __DIR__ . '/../app/config/config.php';

require __DIR__ . '/../app/controllers.php';

require __DIR__ . '/../app/routing.php';

require __DIR__ . '/../app/handlers.php';

$app->run();
