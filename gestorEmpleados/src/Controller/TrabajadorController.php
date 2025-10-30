<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

final class TrabajadorController extends AbstractController
{
    private $trabajadores = [
        1 => ["nombre" => "Abel Sabater", "telefono" => "692813883", "edad" => "19", "cotización" => "1 mes y 11 dias","salario"=>"1500€", "puesto"=>"full stack developer junior"],
        2 => ["nombre" => "Ana López", "telefono" => "58958448", "edad" => "42", "cotización" => "21 años, 5 meses y 20 dias","salario"=>"1500€", "puesto"=>"administrador"],
        5 => ["nombre" => "Mario Montero", "telefono" => "5326824", "edad" => "35", "cotización" => "19 años 11 meses y 1 dia","salario"=>"1500€", "puesto"=>"analista financiero "],
        7 => ["nombre" => "Laura Martínez", "telefono" => "42898966", "edad" => "61", "cotización" => "37 años 5 meses y 7 dias","salario"=>"1500€", "puesto"=>"desarrollador junior"],
        9 => ["nombre" => "Nora Jover", "telefono" => "54565859", "edad" => "16", "cotización" => "1 mes","salario"=>"700€", "puesto"=>"camarero"]
    ];     
    #[Route('/trabajador/{codigo?1}',name: 'inicio')]
    public function ficha($codigo): Response{
        $trabajador=($this->trabajadores[$codigo]?? null);
        
        return $this->render('ficha.html.twig',["trabajador"=>$trabajador]);
        
    }
}
