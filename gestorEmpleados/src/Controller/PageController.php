<?php

namespace App\Controller;

use App\Entity\Empresa;
use App\Entity\Trabajador;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class PageController extends AbstractController
{
    /** El name se tiene que llamar igual que el documento */
    #[Route('/',name: 'index')]
    public function index(ManagerRegistry $doctrine): Response{
        $repositorio = $doctrine->getRepository(Trabajador::class);
        $trabajadores = $repositorio->findAll();
        $repositorio2 = $doctrine->getRepository(Empresa::class);
        $empresas = $repositorio2->findAll();
        return $this->render('index.html.twig', [
    'trabajadores' => $trabajadores,
    'empresas' => $empresas,
]);
    }
}
