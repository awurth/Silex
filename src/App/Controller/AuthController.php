<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return $this->render('Auth/login.twig', [
            'error' => $this->application['security.last_error']($request),
            'last_username' => $this->get('session')->get('_security.last_username')
        ]);
    }
}