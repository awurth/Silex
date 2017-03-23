<?php

namespace App\Controller;

use Doctrine\ORM\EntityManager;
use Silex\Application;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Validator\Validator\RecursiveValidator;
use Twig_Environment;

/**
 * @property Session session
 * @property RecursiveValidator validator
 * @property Twig_Environment twig
 * @property UrlGenerator url_generator
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
     * Get Form Factory
     *
     * @return FormFactory
     */
    public function getFormFactory()
    {
        return $this->application['form.factory'];
    }

    /**
     * Redirect the user to another route
     *
     * @param string $route The route to redirect to
     * @param array $parameters An array of parameters
     * @param int $status The status code (302 by default)
     *
     * @return RedirectResponse
     */
    public function redirect($route, $parameters = [], $status = 302)
    {
        return $this->application->redirect($this->path($route, $parameters), $status);
    }

    /**
     * Redirect the user to another URL
     *
     * @param string $url The URL to redirect to
     * @param int $status The status code (302 by default)
     *
     * @return RedirectResponse
     */
    public function redirectTo($url, $status = 302)
    {
        return $this->application->redirect($url, $status);
    }

    /**
     * Generate a path from the given parameters
     *
     * @param string $route The name of the route
     * @param mixed $parameters An array of parameters
     *
     * @return string The generated path
     */
    public function path($route, $parameters = [])
    {
        return $this->application['url_generator']->generate($route, $parameters, UrlGeneratorInterface::ABSOLUTE_PATH);
    }

    /**
     * Generate an absolute URL from the given parameters
     *
     * @param string $route The name of the route
     * @param mixed $parameters An array of parameters
     *
     * @return string The generated URL
     */
    public function url($route, $parameters = [])
    {
        return $this->application['url_generator']->generate($route, $parameters, UrlGeneratorInterface::ABSOLUTE_URL);
    }

    /**
     * Render a template
     *
     * @param string $name The template name
     * @param array $context An array of parameters to pass to the template
     *
     * @return string
     */
    public function render($name, array $context = [])
    {
        return $this->application['twig']->render($name, $context);
    }

    /**
     * Add a flash message for type
     *
     * @param string $type
     * @param string $message
     */
    public function flash($type, $message)
    {
        $this->application['session']->getFlashBag()->add($type, $message);
    }

    /**
     * Get a service from the container
     *
     * @param string $service The service name
     *
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
