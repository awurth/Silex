<?php

require __DIR__ . '/config.php';

$app['assets.base_path'] = '..';

$app['profiler.cache_dir'] = $app['root_dir'] . '/var/cache/' . $app['environment'] . '/profiler';
