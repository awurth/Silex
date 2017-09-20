<?php

require __DIR__ . '/config.php';

$app['assets.base_path'] = '..';

$app['profiler.cache_dir'] = $app['cache_dir'] . '/profiler';
