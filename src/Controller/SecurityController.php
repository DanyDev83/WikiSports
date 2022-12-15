<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginType;
use App\Form\RegistrationFormType;
use App\Repository\ArticleRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $lastUsername = $authenticationUtils->getLastUsername();
        $error = $authenticationUtils->getLastAuthenticationError();
        $user = new User();

        $formLogin = $this->createForm(LoginType::class, $user);

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'formLogin' => $formLogin->createView(),
        ]);
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    #[Route('/account', name: 'app_account')]
    public function account(ArticleRepository $articleRepository): Response
    {
        $lastArticle = $articleRepository->lastArticle();
        $articles = $articleRepository->listingArticle();

        if (!$this->isGranted('ROLE_USER')) {
            $statut = Response::HTTP_FORBIDDEN;
            $error = "Mon compte";
            $message = "Accès interdit ! Vous devez être connecté pour pouvoir accéder à cette page";
            return $this->render('home/index.html.twig', [
                'articles' => $articles,
                'lastArticle' => $lastArticle,
                'error' => $error,
                'statut' => $statut,
                'message' => $message,
            ]);
        }

        $user = $this->getUser();
        $articlesUser = $articleRepository->findBy( ['user' => $this->getUser()]);
        $nbRowArticles = $articleRepository->countArticlesUser($this->getUser());

        return $this->render('security/account.html.twig', [
            'user' => $user,
            'articles' => $articlesUser,
            'nbArticles' => $nbRowArticles
        ]);
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $em): Response
    {
        $user = new User();

        $formRegistration = $this->createForm(RegistrationFormType::class, $user);
        $formRegistration->handleRequest($request);

        if ($formRegistration->isSubmitted() && $formRegistration->isValid()) {

            $date = new DateTimeImmutable();
            $hashPassword = $passwordHasher->hashPassword($user, $formRegistration->get('plainPassword')->getData());

            $user->setPassword($hashPassword);
            $user->setCreatedAt($date);
            $user->setUpdatedAt($date);

            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('app_home');
        }

        return $this->render('security/register.html.twig', [
            'formRegistration' => $formRegistration->createView()
        ]);
    }
}
