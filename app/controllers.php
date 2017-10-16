<?php

$controllers = [
    'core.controller' => 'App\Core\Controller\CoreController'
];

foreach ($controllers as $key => $class) {
    $app[$key] = function () use ($app, $class) {
        return new $class($app);
    };
}
