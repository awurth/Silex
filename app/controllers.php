<?php

$controllers = [
    'app.controller' => 'App\Controller\AppController'
];

foreach ($controllers as $key => $class) {
    $app[$key] = function () use ($app, $class) {
        return new $class($app);
    };
}
