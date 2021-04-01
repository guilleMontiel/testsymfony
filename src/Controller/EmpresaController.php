<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Empresa;

class EmpresaController extends AbstractController
{
    /**
     * @Route("/empresa", name="empresa")
     */
    public function index(): Response
    {
        $data = $this->getDoctrine()->getManager();
        $empresas = $data->getRepository(Empresa::class)->findAll();
        
        return $this->render('empresa/index.html.twig', [
            'controller_name' => 'Empresas',
            'empresas'=>$empresas
        ]);
    }
    
    /**
     * @Route("/empresa/new", name="new")
     */
    public function new(){
        $empresa = new Empresa();
        return $this->render('empresa/new.html.twing',[
            'controller_name' => 'Nueva Empresa',
            'empresa'=>$empresa
        ]);
    }
}
