<?php

$app->get('/', 'app.controller:homeAction')->bind('home');

$app->get('/login', 'auth.controller:loginAction')->bind('login');
$app->match('/register', 'auth.controller:registerAction')->method('GET|POST')->bind('register');
