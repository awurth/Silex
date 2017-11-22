<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app->error(function (Exception $e, Request $request, $code) use ($app) {
    $templates = [
        'error/' . $code . '.twig',
        'error/' . substr($code, 0, 1) . 'xx.twig',
        'error/error.twig'
    ];

    return new Response($app['twig']->resolveTemplate($templates)->render([
        'code' => $code
    ]), $code);
});
