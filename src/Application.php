<?php

namespace App;

use Silex\Application as App;

class Application extends App
{
    use App\FormTrait;
    use App\MonologTrait;
    use App\SecurityTrait;
    use App\SwiftmailerTrait;
    use App\TranslationTrait;
    use App\TwigTrait;
    use App\UrlGeneratorTrait;

    /**
     * @var string
     */
    protected $environment;

    /**
     * @var string
     */
    protected $rootDir;

    /**
     * Constructor.
     *
     * @param string $environment
     * @param bool   $debug
     * @param array  $values
     */
    public function __construct(string $environment, bool $debug = false, array $values = [])
    {
        parent::__construct($values);

        $this['debug'] = $debug;

        $this->environment = $environment;
        $this->rootDir = $this->getRootDir();

        $this->registerProviders();
        $this->loadConfiguration();
        $this->registerControllers();
        $this->registerHandlers();
        $this->loadRoutes();
    }

    public function getCacheDir()
    {
        return $this->getRootDir().'/var/cache/'.$this->environment;
    }

    public function getConfigurationDir()
    {
        return $this->getRootDir().'/config';
    }

    public function getEnvironment()
    {
        return $this->environment;
    }

    public function getLogDir()
    {
        return $this->getRootDir().'/var/log';
    }

    public function getRootDir()
    {
        if (null === $this->rootDir) {
            $this->rootDir = dirname(__DIR__);
        }

        return $this->rootDir;
    }

    public function loadConfiguration()
    {
        $app = $this;
        if (file_exists($this->getConfigurationDir().'/container.'.$this->getEnvironment().'.php')) {
            require $this->getConfigurationDir().'/container.'.$this->getEnvironment().'.php';
        } else {
            require $this->getConfigurationDir().'/container.php';
        }
    }

    public function loadRoutes()
    {
        $app = $this;
        require $this->getConfigurationDir().'/routes.php';
    }

    public function registerControllers()
    {
        if (file_exists($this->getConfigurationDir().'/controllers.php')) {
            $controllers = require $this->getConfigurationDir().'/controllers.php';
            foreach ($controllers as $key => $class) {
                $this[$key] = function ($app) use ($class) {
                    return new $class($app);
                };
            }
        }
    }

    public function registerHandlers()
    {
        $app = $this;
        require $this->getConfigurationDir().'/handlers.php';
    }

    public function registerProviders()
    {
        $providers = require $this->getConfigurationDir().'/providers.php';
        foreach ($providers as $class => $environments) {
            if (isset($environments['all']) || isset($environments[$this->environment])) {
                $this->register(new $class());
            }
        }
    }
}
