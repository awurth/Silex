<?php

use App\Application;
use Symfony\Component\Debug\Debug;
use Symfony\Component\Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

if (!isset($_SERVER['APP_TEST_ENV'])) {
    if (!class_exists(Dotenv::class)) {
        throw new \RuntimeException('APP_TEST_ENV environment variable is not defined. You need to define environment variables for configuration or add "symfony/dotenv" as a Composer dependency to load variables from a .env file.');
    }
    (new Dotenv())->load(__DIR__.'/../.env');
}

$env = $_SERVER['APP_TEST_ENV'] ?? 'test';
$debug = $_SERVER['APP_DEBUG'] ?? ('prod' !== $env);

if ($debug) {
    Debug::enable();
}

return new Application($env, $debug);
