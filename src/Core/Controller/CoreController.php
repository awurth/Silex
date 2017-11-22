<?php

namespace App\Core\Controller;

class CoreController extends Controller
{
    public function homeAction()
    {
        return $this->render('app/home.twig');
    }
}
