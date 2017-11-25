<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Silex\Application;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Validator\Validator\RecursiveValidator;
use Twig\Environment;

/**
 * @property EventDispatcher    dispatcher
 * @property RecursiveValidator validator
 * @property Session            session
 * @property Environment        twig
 * @property UrlGenerator       url_generator
 * @property string             environment
 * @property string             root_dir
 */
abstract class Controller
{
    /**
     * @var Application
     */
    protected $application;

    /**
     * Constructor.
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->application = $app;
    }

    /**
     * Returns a new AccessDeniedException.
     *
     * @param string $message
     *
     * @return AccessDeniedException
     */
    protected function createAccessDeniedException($message = 'Access Denied.')
    {
        return new AccessDeniedException($message);
    }

    /**
     * Returns a new NotFoundHttpException.
     *
     * @param string $message
     *
     * @return NotFoundHttpException
     */
    protected function createNotFoundHttpException($message = 'Not Found')
    {
        return new NotFoundHttpException($message);
    }

    /**
     * Throws an exception unless the attributes are granted against the current authentication token.
     *
     * @param mixed  $roles
     * @param string $message
     *
     * @throws AccessDeniedException
     */
    protected function denyAccessUnlessGranted($roles, $message = 'Access Denied.')
    {
        if (!$this->isGranted($roles)) {
            $exception = $this->createAccessDeniedException($message);
            $exception->setAttributes($roles);

            throw $exception;
        }
    }

    /**
     * Gets Doctrine Entity Manager.
     *
     * @return EntityManager
     */
    public function getEntityManager()
    {
        return $this->application['orm.em'];
    }

    /**
     * Gets the Form Factory.
     *
     * @return FormFactory
     */
    public function getFormFactory()
    {
        return $this->application['form.factory'];
    }

    /**
     * Gets the project root directory.
     *
     * @return string
     */
    public function getRootDir()
    {
        return $this->application['root_dir'];
    }

    /**
     * Gets the router.
     *
     * @return UrlGenerator
     */
    public function getRouter()
    {
        return $this->application['url_generator'];
    }

    /**
     * Gets the session.
     *
     * @return Session
     */
    public function getSession()
    {
        return $this->application['session'];
    }

    /**
     * Gets the Twig service.
     *
     * @return Environment
     */
    public function getTwig()
    {
        return $this->application['twig'];
    }

    /**
     * Gets the current authenticated user or null if not logged in.
     *
     * @return User|null
     */
    public function getUser()
    {
        $user = $this->application['security.token_storage']->getToken()->getUser();
        if ($user instanceof User) {
            return $user;
        }

        return null;
    }

    /**
     * Redirects the user to another route.
     *
     * @param string $route
     * @param array $parameters
     * @param int $status
     *
     * @return RedirectResponse
     */
    public function redirect($route, $parameters = [], $status = 302)
    {
        return $this->application->redirect($this->path($route, $parameters), $status);
    }

    /**
     * Redirects the user to another URL.
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
     * Generates a path from the given parameters.
     *
     * @param string $route
     * @param mixed $parameters
     *
     * @return string
     */
    public function path($route, $parameters = [])
    {
        return $this->getRouter()->generate($route, $parameters, UrlGenerator::ABSOLUTE_PATH);
    }

    /**
     * Generates an absolute URL from the given parameters.
     *
     * @param string $route
     * @param mixed $parameters
     *
     * @return string
     */
    public function url($route, $parameters = [])
    {
        return $this->getRouter()->generate($route, $parameters, UrlGenerator::ABSOLUTE_URL);
    }

    /**
     * Renders a twig template.
     *
     * @param string $name
     * @param array $context
     *
     * @return string
     */
    public function render($name, array $context = [])
    {
        return $this->getTwig()->render($name, $context);
    }

    /**
     * Adds a flash message.
     *
     * @param string $type
     * @param string $message
     */
    public function flash($type, $message)
    {
        $this->getSession()->getFlashBag()->add($type, $message);
    }

    /**
     * Checks if user is granted a role.
     *
     * @param string $role
     *
     * @return bool
     */
    public function isGranted($role)
    {
        return $this->application['security.authorization_checker']->isGranted($role);
    }

    /**
     * Get a service from the container
     *
     * @param string $service
     *
     * @return mixed
     */
    public function get($service)
    {
        return $this->application[$service];
    }

    /**
     * Gets a service from the container.
     *
     * @param string $property
     *
     * @return mixed
     */
    public function __get($property)
    {
        return $this->application[$property];
    }
}
