<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CategorieController extends AbstractController
{
    #[Route('/categorie', name: 'app_categorie')]
    public function index(CategorieRepository $categorieRepository): Response
    {
        $categories = $categorieRepository->findAll();
        return $this->render('categorie/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/categorie/add', name: 'app_categorie_add')]
    public function add(Request $request, EntityManagerInterface $entityManager) {
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // on demande à Doctrine de s'occuper de l'object $categorie
            $entityManager->persist($categorie);
            // On execute les instructions SQL
            $entityManager->flush();
            return $this->redirectToRoute('app_categorie');
        }

        return $this->render('categorie/add.html.twig',
            ["form" => $form]);
    }

    #[Route('/categorie/{id}', name: 'app_categorie_show')]
    public function show(CategorieRepository $categorieRepository, $id): Response
    {
        $categorie = $categorieRepository->find($id);
        return $this->render('categorie/show.html.twig', [
            'categorie' => $categorie,
        ]);
    }


}
