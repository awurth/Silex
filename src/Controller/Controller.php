<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use App\Application;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
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
 * @property string             env
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
     * Get a service from the container
     *
     * @param string $service
     *
     * @return mixed
     */
    protected function get($service)
    {
        return $this->application[$service];
    }

    /**
     * Gets Doctrine Entity Manager.
     *
     * @return EntityManager
     */
    protected function getEntityManager()
    {
        return $this->application['orm.em'];
    }

    /**
     * Gets the environment.
     *
     * @return string
     */
    protected function getEnv()
    {
        return $this->application->getEnvironment();
    }

    /**
     * Gets the Form Factory.
     *
     * @return FormFactory
     */
    protected function getFormFactory()
    {
        return $this->application['form.factory'];
    }

    /**
     * Gets the project root directory.
     *
     * @return string
     */
    protected function getRootDir()
    {
        return $this->application->getRootDir();
    }

    /**
     * Gets the router.
     *
     * @return UrlGenerator
     */
    protected function getRouter()
    {
        return $this->application['url_generator'];
    }

    /**
     * Gets the session.
     *
     * @return Session
     */
    protected function getSession()
    {
        return $this->application['session'];
    }

    /**
     * Gets the Twig service.
     *
     * @return Environment
     */
    protected function getTwig()
    {
        return $this->application['twig'];
    }

    /**
     * Gets the current authenticated user or null if not logged in.
     *
     * @return User|null
     */
    protected function getUser()
    {
        $user = $this->application['security.token_storage']->getToken()->getUser();
        if ($user instanceof User) {
            return $user;
        }

        return null;
    }

    /**
     * Adds a flash message.
     *
     * @param string $type
     * @param string $message
     */
    protected function flash($type, $message)
    {
        $this->getSession()->getFlashBag()->add($type, $message);
    }

    /**
     * Creates and returns a form builder instance.
     *
     * @param mixed                    $data    The initial data for the form
     * @param array                    $options Options for the form
     * @param string|FormTypeInterface $type    Type of the form
     *
     * @return FormBuilder
     */
    protected function form($data = null, array $options = [], $type = null)
    {
        return $this->application->form($type, $data, $options);
    }

    /**
     * Checks if the attributes are granted against the current authentication token and optionally supplied object.
     *
     * @param mixed $attributes
     * @param mixed $object
     *
     * @return bool
     */
    protected function isGranted($attributes, $object = null)
    {
        return $this->application->isGranted($attributes, $object);
    }

    /**
     * Generates a path from the given parameters.
     *
     * @param string $route      The name of the route
     * @param mixed  $parameters An array of parameters
     *
     * @return string
     */
    protected function path($route, $parameters = [])
    {
        return $this->application->path($route, $parameters);
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
    protected function redirect($route, $parameters = [], $status = 302)
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
    protected function redirectTo($url, $status = 302)
    {
        return $this->application->redirect($url, $status);
    }

    /**
     * Renders a view and returns a Response.
     *
     * @param string   $view       The view name
     * @param array    $parameters An array of parameters to pass to the view
     * @param Response $response   A Response instance
     *
     * @return Response
     */
    protected function render($view, array $parameters = [], Response $response = null)
    {
        return $this->application->render($view, $parameters, $response);
    }

    /**
     * Translates the given message.
     *
     * @param string $id         The message id
     * @param array  $parameters An array of parameters for the message
     * @param string $domain     The domain for the message
     * @param string $locale     The locale
     *
     * @return string
     */
    protected function trans($id, array $parameters = [], $domain = 'messages', $locale = null)
    {
        return $this->application->trans($id, $parameters, $domain, $locale);
    }

    /**
     * Generates an absolute URL from the given parameters.
     *
     * @param string $route      The name of the route
     * @param mixed  $parameters An array of parameters
     *
     * @return string
     */
    protected function url($route, $parameters = [])
    {
        return $this->application->url($route, $parameters);
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
