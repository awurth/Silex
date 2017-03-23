<?php

namespace App\Controller;

use Doctrine\ORM\EntityManager;
use Silex\Application;
use Symfony\Component\HttpFoundation\Session\Session;
use Twig_Environment;

/**
 * @property Session session
 * @property Twig_Environment twig
 */
class Controller
{
    /**
     * @var Application
     */
    protected $application;

    public function __construct(Application $app)
    {
        $this->application = $app;
    }

    /**
     * Get Doctrine Entity Manager
     *
     * @return EntityManager
     */
    public function getEntityManager()
    {
        return $this->application['orm.em'];
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
        return $this->application['twig']->render($name, $context);
    }

    /**
     * @param string $service The service name
     * @return mixed
     */
    public function get($service)
    {
        return $this->application[$service];
    }

    public function __get($property)
    {
        return $this->application[$property];
    }
}
