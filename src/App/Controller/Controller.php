<?php

namespace App\Controller;

use Pimple\Container;
use Twig_Environment;

/**
 * @property Twig_Environment twig
 */
class Controller
{
    /**
     * @var Container
     */
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function __get($property)
    {
        return $this->container[$property];
    }
}
