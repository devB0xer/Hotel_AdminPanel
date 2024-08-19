<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SomePageController extends AbstractController
{
    #[Route('/some/page', name: 'app_some_page')]
    public function index(): Response
    {
        return $this->render('some_page/index.html.twig', [
            'controller_name' => 'SomePageController',
        ]);
    }

    #[Route('/some/secret', name: 'app_some_secret')]
    public function secretPage(): Response
    {
        return $this->render('some_page/secret_page.html.twig', [
            'secret' => 'wow! Secret...',
        ]);
    }
}
