<?php

use AWurth\SilexUser\Provider\SilexUserServiceProvider;

$app->get('/', 'app.controller:homeAction')->bind('home');

$app->mount('/', new SilexUserServiceProvider());
