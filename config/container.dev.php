<?php

require __DIR__ . '/container.php';

$app['profiler.cache_dir'] = $app->getCacheDir().'/profiler';
