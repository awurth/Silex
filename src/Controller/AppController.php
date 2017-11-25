<?php

namespace App\Controller;

class AppController extends Controller
{
    public function homeAction()
    {
        return $this->render('app/home.twig');
    }
}
