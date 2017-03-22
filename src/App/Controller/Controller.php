<?php

namespace App\Controller;

use Pimple\Container;
use Symfony\Component\HttpFoundation\Session\Session;
use Twig_Environment;

/**
 * @property Session session
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

    /**
     * Render a template
     *
     * @param string $name The template name
     * @param array $context An array of parameters to pass to the template
     * @return string
     */
    public function render($name, array $context = [])
    {
        return $this->twig->render($name, $context);
    }

    public function __get($property)
    {
        return $this->container[$property];
    }
}
