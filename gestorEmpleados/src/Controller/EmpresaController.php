<?php

namespace App\Controller;

use Exception;
use App\Entity\Empresa;
use App\Entity\Trabajador;
use App\Form\EmpresaFormType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class EmpresaController extends AbstractController
{
    #[Route('/empresa/editar/{codigo?1}', name: 'editarempresa')]
    public function editar(ManagerRegistry $doctrine, Request $request, int $codigo) {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
    $entityManager = $doctrine ->getManager();
    $repositorio = $doctrine->getRepository(Empresa::class);
    $empresa = $repositorio->find($codigo);
    if ($empresa){
        $formulario = $this->createForm(EmpresaFormType::class, $empresa);

        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {
            $empresa = $formulario->getData();
            $entityManager = $doctrine->getManager();
            $entityManager->persist($empresa);
            $entityManager->flush();
            return $this->redirectToRoute('inicioempresa', ["codigo" => $empresa->getId()]);
        }
        return $this->render('nuevaempresa.html.twig', array(
            'formulario' => $formulario->createView()
        ));
    }else{
        return $this->render('empresa.html.twig', [
            'trabajador' => NULL
        ]);
    }
}

    #[Route('/empresa/nueva', name: 'nuevaEmpresa')]
    public function nuevo(ManagerRegistry $doctrine, Request $request) {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $entityManager = $doctrine ->getManager();
        $empresa = new Empresa();
        $formulario = $this->createForm(EmpresaFormType::class, $empresa);
        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {
            $empresa = $formulario->getData();
            
            $entityManager = $doctrine->getManager();
            $entityManager->persist($empresa);
            $entityManager->flush();
            return $this->redirectToRoute('inicioempresa', ["codigo" => $empresa->getId()]);
        }
        return $this->render('nuevaempresa.html.twig', array(
            'formulario' => $formulario->createView()
        ));
    }
    #[Route('/empresa/delete/{id}',name: 'eliminarempresa')]
    public function delete(ManagerRegistry $doctrine,$id){
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $entityManager=$doctrine->getManager();
        $repositorio=$doctrine->getRepository(Empresa::class);
        $empresa=$repositorio->find($id);
        $trabajadorRepo = $doctrine->getRepository(Trabajador::class);
        if($empresa){
            try{
            $trabajadores = $trabajadorRepo->findBy(['empresa' => $empresa]);
                foreach ($trabajadores as $trabajador) {
                    $trabajador->setEmpresa(null);
                    $entityManager->persist($trabajador);
                }
                $entityManager->remove($empresa);
                $entityManager->flush();
                return new Response("Empresa eliminada");
            } catch(\Exception $e){
                return new Response("Error");
            }
        }else{
            return $this->render('empresa.html.twig',["empresa"=>null]);
        }
        
    }
    #[Route('/empresa/{codigo?1}',name: 'inicioempresa')]
    public function ficha(ManagerRegistry $doctrine,$codigo): Response{

        $repositorio=$doctrine->getRepository(Empresa::class);
        $empresa=$repositorio->find($codigo);

        return $this->render('empresa.html.twig',["empresa"=>$empresa]);
        
    }

}