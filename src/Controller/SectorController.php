<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Sector;
use Symfony\Component\HttpFoundation\Request;
use App\Form\SectorType;
class SectorController extends AbstractController
{
    /**
     * @Route("/sector", name="sector")
     */
    public function index(): Response
    {   
        $data = $this->getDoctrine()->getManager();
        $sectores = $data->getRepository(Sector::class)->findAll();
        return $this->render('sector/index.html.twig', [
            'sectores'=>$sectores
        ]);
    }
    
    /**
     * @Route("/sector/new", name="new")
     */
    public function new(Request $request){
                
        
        $sector = new Sector();
        $form = $this->createForm(SectorType::class,$sector);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
             $data = $this->getDoctrine()->getManager();
             $data->persist($sector);
             $data->flush();
             
             $this->addFlash('success', 'Se creo la sector exitosamente');
            return $this->redirectToRoute('sector');
        }
        
        return $this->render('sector/new.html.twig',[
            'form'=>$form->createView()
        ]);
    }
    
    /**
     * @Route("/sector/update", name="update")
     */
    public function update(int $id, Request $request){
                
        
        $sector = $this->getDoctrine()->getRepository(Sector::class)->find($id);
        $form = $this->createForm(SectorType::class,$sector);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

             $data = $this->getDoctrine()->getManager();
             $data->persist($sector);
             $data->flush();
             
             $this->addFlash('success', 'Se actualizo la sector exitosamente');
            return $this->redirectToRoute('sector');
        }
        
        return $this->render('sector/new.html.twig',[
            'form'=>$form->createView()
        ]);
    }
    
    /**
     * @Route("/sector/delete", name="delete")
     */
    public function delete(int $id){
                
        $entityManager = $this->getDoctrine()->getManager();
        $sector = $entityManager->getRepository(Sector::class)->find($id);
        
        $empresas = $sector->getEmpresas();

        $entityManager->remove($sector);
        $entityManager->flush();
        $this->addFlash('success', 'Se elimino la sector exitosamente');
        return $this->redirectToRoute('sector');
                
    }
}
