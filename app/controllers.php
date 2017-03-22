<?php

use App\Controller\AppController;

$app['app.controller'] = function () use ($app) {
    return new AppController($app);
};
