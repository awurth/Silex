<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;

class AppController extends Controller
{
    public function homeAction()
    {
        return $this->render('App/home.twig');
    }
}
