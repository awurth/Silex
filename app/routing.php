<?php

$app->get('/', 'app.controller:home')->bind('home');

$app->get('/login', 'auth.controller:login')->bind('login');
