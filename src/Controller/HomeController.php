<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{

    #[Route('/', name: 'app_home')]
    public function index(ArticleRepository $articleRepository, CategoryRepository $categoryRepository): Response
    {
        $articles = $articleRepository->findAll();
        $categories = $categoryRepository->findAll();
        $randomArticles = $articleRepository->randomArticles($articles);
        $randomCategories = $categoryRepository->randomCategories($categories);

        return $this->render('home/index.html.twig', [
            'articles' => $articles,
            'randomArticles' => $randomArticles,
            'randomCategories' => $randomCategories,
        ]);
    }

    public function navbar(): Response
    {
        return $this->render('layout/navbar.html.twig');
    }
}
