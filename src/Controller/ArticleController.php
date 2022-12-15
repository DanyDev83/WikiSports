<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    #[Route('/article/{id}', name: 'app_article', priority:-1)]
    public function index($id, ArticleRepository $articleRepository): Response
    {
        $article = $articleRepository->find($id);
        $error = null;

        return $this->render('article/index.html.twig', [
            'article' => $article,
            'error' => $error,
        ]);
    }

    #[Route('/article/delete/{id}', name: 'app_deleteArticle')]
    public function deleteArticle($id, ArticleRepository $articleRepository, EntityManagerInterface $em, CategoryRepository $categoryRepository): Response
    {
        $article = $articleRepository->find($id);
        $articles = $articleRepository->findAll();
        $categories = $categoryRepository->findAll();
        $randomArticles = $articleRepository->randomArticles($articles);
        $randomCategories = $categoryRepository->randomCategories($categories);

        if (!$this->isGranted('ARTICLE_POST_DELETE', $article)) {
            $statut = Response::HTTP_FORBIDDEN;
            $error = "Suppression d'un article";
            $message = "Accès interdit";
            return $this->render('home/index.html.twig', [
                'articles' => $articles,
                'error' => $error,
                'randomArticles' => $randomArticles,
                'randomCategories' => $randomCategories,
                'statut' => $statut,
                'message' => $message,
            ]);
        }

        $em->remove($article);
        $em->flush($article);
        return $this->redirectToRoute('app_home');
    }

    #[Route('/article/edit/{id}', name: 'app_editArticle')]
    public function editArticle($id, ArticleRepository $articleRepository, Request $request, EntityManagerInterface $em, CategoryRepository $categoryRepository): Response
    {
        $articles = $articleRepository->findAll();
        $categories = $categoryRepository->findAll();
        $randomArticles = $articleRepository->randomArticles($articles);
        $randomCategories = $categoryRepository->randomCategories($categories);

        $article = $articleRepository->find($id);
        if (!$this->isGranted('ARTICLE_POST_EDIT', $article)) {
            $statut = Response::HTTP_FORBIDDEN;
            $error = "Modification d'un article";
            $message = "Accès interdit";
            return $this->render('home/index.html.twig', [
                'articles' => $articles,
                'randomArticles' => $randomArticles,
                'randomCategories' => $randomCategories,
                'error' => $error,
                'statut' => $statut,
                'message' => $message,
            ]);
        }

        $formEditArticle = $this->createForm(ArticleType::class, $article);
        $formEditArticle->handleRequest($request);

        if ($formEditArticle->isSubmitted() && $formEditArticle->isValid()) {
            $article->setUpdatedAt(new DateTimeImmutable('now'));

            $em->persist($article);
            $em->flush($article);

            return $this->redirectToRoute('app_article', [
                'id' => $article->getId(),
            ]);
        }

        return $this->render('article/editArticle.html.twig', [
            'formEditArticle' => $formEditArticle->createView(),
            'article' => $article,
        ]);
    }

    #[Route('/article/new', name: 'app_newArticle')]
    public function new(ManagerRegistry $doctrine, Request $request, ArticleRepository $articleRepository, CategoryRepository $categoryRepository): Response
    {
        $article = new Article();
        $articles = $articleRepository->findAll();
        $categories = $categoryRepository->findAll();
        $randomArticles = $articleRepository->randomArticles($articles);
        $randomCategories = $categoryRepository->randomCategories($categories);

        if (!$this->isGranted('ARTICLE_POST_CREATE', $article)) {
            $statut = Response::HTTP_FORBIDDEN;
            $error = "Création d'un article";
            $message = "Accès interdit ! Vous devez être connecté pour pouvoir accéder à cette page";
            return $this->render('home/index.html.twig', [
                'articles' => $articles,
                'randomArticles' => $randomArticles,
                'randomCategories' => $randomCategories,
                'error' => $error,
                'statut' => $statut,
                'message' => $message,
            ]);
        }

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article->setUser($this->getUser());
            $repo = new ArticleRepository($doctrine);
            $repo->save($article, true);

            return $this->redirectToRoute('app_article', [
                'id' => $article->getId(),
            ]);
        }

        return $this->render('article/newArticle.html.twig', [
            'formAddArticle' => $form->createView(),
        ]);
    }
}
