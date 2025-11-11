<?php

namespace App\Controller;

use Exception;
use App\Entity\Empresa;
use App\Entity\Trabajador;
use App\Form\TrabajadorFormType as TrabajadorType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class TrabajadorController extends AbstractController
{
    #[Route('/trabajador/nuevo', name: 'nuevo')]
    public function nuevo(ManagerRegistry $doctrine, Request $request) {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $entityManager = $doctrine ->getManager();
        $trabajador = new Trabajador();
        $formulario = $this->createForm(TrabajadorType::class, $trabajador);
        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {
            $trabajador = $formulario->getData();
            
            $entityManager = $doctrine->getManager();
            $entityManager->persist($trabajador);
            $entityManager->flush();
            return $this->redirectToRoute('ficha', ["codigo" => $trabajador->getId()]);
        }
        return $this->render('nuevo.html.twig', array(
            'formulario' => $formulario->createView()
        ));
    }

    #[Route('/trabajador/editar/{codigo?1}', name: 'editar')]
    public function editar(ManagerRegistry $doctrine, Request $request, int $codigo) {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
    $entityManager = $doctrine ->getManager();
    $repositorio = $doctrine->getRepository(Trabajador::class);
    $trabajador = $repositorio->find($codigo);
    if ($trabajador){
        $formulario = $this->createForm(TrabajadorType::class, $trabajador);

        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {
            $trabajador = $formulario->getData();
            $entityManager = $doctrine->getManager();
            $entityManager->persist($trabajador);
            $entityManager->flush();
            return $this->redirectToRoute('ficha', ["codigo" => $trabajador->getId()]);
        }
        return $this->render('nuevo.html.twig', array(
            'formulario' => $formulario->createView()
        ));
    }else{
        return $this->render('ficha.html.twig', [
            'trabajador' => NULL
        ]);
    }
}

    #[Route('/trabajador/delete/{id?1}',name: 'eliminar')]
    public function delete(ManagerRegistry $doctrine,$id){
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $entityManager=$doctrine->getManager();
        $repositorio=$doctrine->getRepository(Trabajador::class);
        $trabajador=$repositorio->find($id);
        if($trabajador){
            try{
                $entityManager->remove($trabajador);
                $entityManager->flush();
                return new Response("Trabajador eliminado");
            } catch(\Exception $e){
                return new Response("Error");
            }
        }else{
            return $this->render('ficha.html.twig',["trabajador"=>null]);

        }
        
    }
    
    #[Route('/trabajador/{codigo?1}',name: 'ficha')]
    public function ficha(ManagerRegistry $doctrine,$codigo): Response{
        $repositorio=$doctrine->getRepository(Trabajador::class);
        $trabajador=$repositorio->find($codigo);

        return $this->render('ficha.html.twig',["trabajador"=>$trabajador]);
        
    }  
}
