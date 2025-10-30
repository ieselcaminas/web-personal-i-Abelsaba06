<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PageController extends AbstractController
{
    /** El name se tiene que llamar igual que el documento */
    #[Route('/',name: 'index')]
    public function index(): Response{
        return $this->render('index.html.twig');
    }
}
