<?php

require __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application([
    'debug' => true
]);

require __DIR__ . '/../app/dependencies.php';

require __DIR__ . '/../app/controllers.php';

require __DIR__ . '/../app/routing.php';

$app->run();
