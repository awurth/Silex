<?php

namespace App\Controller;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Form;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\EqualTo;
use Symfony\Component\Validator\Constraints\IsNull;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;

class AuthController extends Controller
{
    public function loginAction(Request $request)
    {
        return $this->render('Auth/login.twig', [
            'error' => $this->application['security.last_error']($request),
            'last_username' => $this->get('session')->get('_security.last_username')
        ]);
    }

    public function registerAction(Request $request)
    {
        $user = new User();

        $form = $this->getFormFactory()->createBuilder(FormType::class, $user)
            ->add('username', TextType::class)
            ->add('email', EmailType::class)
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_name' => 'password',
                'second_name' => 'confirm_password',
                'invalid_message' => 'The password fields must match.'
            ])
            ->getForm();

        if ($form->handleRequest($request)->isValid()) {
            $user->setSalt('');
            $user->setPassword($this->users->encodePassword($user, $user->getPassword()));

            $em = $this->getEntityManager();

            $em->persist($user);
            $em->flush();

            $this->flash('success', 'Account created.');

            return $this->redirect('login');
        }

        return $this->render('Auth/register.twig', [
            'form' => $form->createView()
        ]);
    }
}
