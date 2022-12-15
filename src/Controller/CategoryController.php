<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\ArticleRepository;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use DateTimeImmutable;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    #[Route('/categories', name:'app_categories', priority:-1)]
    public function index(ArticleRepository $articleRepository): Response
    {
        $categoriesWithCountNbArticles = $articleRepository->allCategoriesWithCountNbArticles();

        return $this->render('category/index.html.twig', [
            'categories' => $categoriesWithCountNbArticles
        ]);
    }

    #[Route('/category/{id}', name: 'app_category', priority:-1)]
    public function oneCategory($id, CategoryRepository $categoryRepository, ArticleRepository $articleRepository): Response
    {
        $category = $categoryRepository->find($id);
        $articles = $articleRepository->findBy( ['category' => $id] );

        return $this->render('category/oneCategory.html.twig', [
            'category' => $category,
            'articles' => $articles,
        ]);
    }

    #[Route('/category/new', name: 'app_newCategory')]
    public function new(ManagerRegistry $doctrine, Request $request): Response
    {
        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $category->setCreatedAt(new DateTimeImmutable('now'));
            $category->setUpdatedAt(new DateTimeImmutable('now'));

            $repo = new CategoryRepository($doctrine);
            $repo->save($category, true);

            return $this->redirectToRoute('app_newCategory');
        }

        return $this->render('category/newCategory.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
