<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\CategoryRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $em, CategoryRepository $categoryRepository): Response
    {
        $user = new User();
        $categories = $categoryRepository->findAll();

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

        return $this->render('registration/register.html.twig', [
            'categories' => $categories,
            'formRegistration' => $formRegistration->createView()
        ]);
    }
}
