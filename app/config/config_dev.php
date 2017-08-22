<?php

require __DIR__ . '/config.php';

$app['assets.base_path'] = '..';

$app['profiler.cache_dir'] = ROOT_DIR . 'var/cache/' . $app['environment'] . '/profiler';
