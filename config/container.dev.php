<?php

require $app->getConfigurationDir().'/container.php';

$app['profiler.cache_dir'] = $app->getCacheDir().'/profiler';
