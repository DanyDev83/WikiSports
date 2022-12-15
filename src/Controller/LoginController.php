<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginType;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils, CategoryRepository $categoryRepository): Response
    {
        $lastUsername = $authenticationUtils->getLastUsername();
        $error = $authenticationUtils->getLastAuthenticationError();
        $user = new User();

        $categories = $categoryRepository->findAll();
        $formLogin = $this->createForm(LoginType::class, $user);

        return $this->render('login/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'categories' => $categories,
            'formLogin' => $formLogin->createView(),
        ]);
    }
}
