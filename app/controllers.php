<?php

use App\Controller\AppController;
use App\Controller\AuthController;

$app['app.controller'] = function () use ($app) {
    return new AppController($app);
};

$app['auth.controller'] = function () use ($app) {
    return new AuthController($app);
};
