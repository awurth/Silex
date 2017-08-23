<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app->error(function (Exception $e, Request $request, $code) use ($app) {
    $templates = [
        'Error/' . $code . '.twig',
        'Error/' . substr($code, 0, 1) . 'xx.twig',
        'Error/error.twig'
    ];

    return new Response($app['twig']->resolveTemplate($templates)->render([
        'code' => $code
    ]), $code);
});
