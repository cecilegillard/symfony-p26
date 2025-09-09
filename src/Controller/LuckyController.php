<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class LuckyController extends AbstractController
{
    #[Route('/lucky', name: 'app_lucky')]
    public function index(): Response
    {
        return $this->render('lucky/index.html.twig', [
            'controller_name' => 'Cécile',
        ]);
    }

    #[Route('/luckyNumber', name: 'app_luckynumber')]
    public function number(): Response
    {
        return new Response ( random_int(0, 100) );
    }
}
