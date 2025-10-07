<?php

namespace App\Controller;

use App\Form\ArticleType;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class ArticleController extends AbstractController
{
    #[Route('/article', name: 'app_article')]
    public function index(ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findAll();
       // dd($articles);
        return $this->render('article/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    #[Route('/article/add', name: 'app_article_add')]
    #[IsGranted("ROLE_USER")]
    public function add(Request $request, EntityManagerInterface $entityManager) {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // on demande à Doctrine de s'occuper de l'object
            $entityManager->persist($article);
            // On execute les instructions SQL
            $entityManager->flush();
            return $this->redirectToRoute('app_article');
        }

        return $this->render('article/add.html.twig',
            ["form" => $form]);
    }

    #[Route('/article/{id}', name: 'app_article_show')]
    public function show(ArticleRepository $articleRepository, $id): Response
    {
        $article = $articleRepository->find($id);
        return $this->render('article/show.html.twig', [
            'article' => $article,
        ]);
    }
}
