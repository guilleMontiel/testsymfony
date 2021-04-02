<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Empresa;
use App\Form\EmpresaType;
use Symfony\Component\HttpFoundation\Request;

class EmpresaController extends AbstractController
{
    /**
     * @Route("/empresa", name="empresa")
     */
    public function index()
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
    public function new(Request $request){
                
        
        $empresa = new Empresa();
        $form = $this->createForm(EmpresaType::class,$empresa);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
             $data = $this->getDoctrine()->getManager();
             $data->persist($empresa);
             $data->flush();
             
             $this->addFlash('success', 'Se creo la empresa exitosamente');
            return $this->redirectToRoute('empresa');
        }
        
        return $this->render('empresa/new.html.twig',[
            'form'=>$form->createView()
        ]);
    }
    
    /**
     * @Route("/empresa/update", name="update")
     */
    public function update(int $id, Request $request){
                
        
        $empresa = $this->getDoctrine()->getRepository(Empresa::class)->find($id);
        $form = $this->createForm(EmpresaType::class,$empresa);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

             $data = $this->getDoctrine()->getManager();
             $data->persist($empresa);
             $data->flush();
             
             $this->addFlash('success', 'Se actualizo la empresa exitosamente');
            return $this->redirectToRoute('empresa');
        }
        
        return $this->render('empresa/new.html.twig',[
            'form'=>$form->createView()
        ]);
    }
    
    /**
     * @Route("/empresa/delete", name="delete")
     */
    public function delete(int $id){
                
        $entityManager = $this->getDoctrine()->getManager();
        $empresa = $entityManager->getRepository(Empresa::class)->find($id);
        $entityManager->remove($empresa);
        $entityManager->flush();
        $this->addFlash('success', 'Se elimino la empresa exitosamente');
        return $this->redirectToRoute('empresa');
                
    }
    
    
}
