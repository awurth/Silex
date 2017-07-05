<?php

use Silex\Application;

require __DIR__ . '/../vendor/autoload.php';

$app = new Application();

require __DIR__ . '/../app/providers.php';

require __DIR__ . '/../app/controllers.php';

require __DIR__ . '/../app/routing.php';

$app->run();
