<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Sector;
use Symfony\Component\HttpFoundation\Request;
use App\Form\SectorType;
use App\Entity\Empresa;
use App\Entity\ClienteSector;
use App\Form\ClienteSectorType;
use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
class SectorController extends AbstractController
{
    /**
     * @Route("/sector", name="sector")
     * 
     */
    public function index(): Response
    {   
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        if($this->isGranted('ROLE_CLIENTE')){
            return $this->redirectToRoute('cliente_sector');
        } 
        $data = $this->getDoctrine()->getManager();
        $sectores = $data->getRepository(Sector::class)->findAll();
        return $this->render('sector/index.html.twig', [
            'sectores'=>$sectores
        ]);
    }
    
    /**
     * @Route("/sector/new", name="new")
     * @IsGranted("ROLE_ADMIN")
     */
    public function new(Request $request){
                
        
        $sector = new Sector();
        $form = $this->createForm(SectorType::class,$sector);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
             $sector_encontrado = $this->getDoctrine()->getRepository(Sector::class)->findBy(['nombre'=>$form['nombre']->getData()]);  
             
             if($sector_encontrado){
                 $this->addFlash('error', 'El Nombre del sector ya existe!');
                    return $this->redirectToRoute('sector');
             }
             $data = $this->getDoctrine()->getManager();
             $data->persist($sector);
             $data->flush();
             
             $this->addFlash('success', 'Se creo el sector exitosamente');
            return $this->redirectToRoute('sector');
        }
        
        return $this->render('sector/new.html.twig',[
            'form'=>$form->createView(),
            'controller_name'=>'Nuevo Sector'
        ]);
    }
    
    /**
     * @Route("/sector/update", name="update")
     * @IsGranted("ROLE_ADMIN")
     */
    public function update(int $id, Request $request){
                
        
        $sector = $this->getDoctrine()->getRepository(Sector::class)->find($id);
        $form = $this->createForm(SectorType::class,$sector);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
             $sector_encontrado = $this->getDoctrine()->getRepository(Sector::class)->findBy(['nombre'=>$form['nombre']->getData()]);               
             if($sector_encontrado){
                 $this->addFlash('error',  'El Nombre del sector ya existe!');
                    return $this->redirectToRoute('sector');
             }
             
             $data = $this->getDoctrine()->getManager();
             $data->persist($sector);
             $data->flush();
             
             $this->addFlash('success', 'Se actualizo el sector exitosamente');
            return $this->redirectToRoute('sector');
        }
        
        return $this->render('sector/new.html.twig',[
            'form'=>$form->createView(),
            'controller_name'=>'Actualizar Sector'
        ]);
    }
    
    /**
     * @Route("/sector/delete", name="delete")
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(int $id){
                
        $entityManager = $this->getDoctrine()->getManager();
        $sector = $entityManager->getRepository(Sector::class)->find($id);
        
        $empresas = $sector->getEmpresas();
        if(count($empresas)>0){
            $this->addFlash('error', 'El sector tiene Empresas asociadas.');
            return $this->redirectToRoute('sector');
        }
        
        $entityManager->remove($sector);
        $entityManager->flush();
        $this->addFlash('success', 'Se elimino la sector exitosamente');
        return $this->redirectToRoute('sector');
                
    }
    
     /**
     * @Route("/sector/asociar", name="asociar")
      * @IsGranted("ROLE_ADMIN")
     */
    public function asociar(Request $request){
         $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');           
        $cliente_sector = new ClienteSector();
        $form = $this->createForm(ClienteSectorType::class,$cliente_sector);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
             $data = $this->getDoctrine()->getManager();
             $data->persist($cliente_sector);
             $data->flush();
             
            $this->addFlash('success', 'Se asocio el sector al cliente.');
            return $this->redirectToRoute('sector');
        }
        
        return $this->render('sector/asociar_cliente.html.twig',[
            'controller_name'=>'Asociar Cliente',
            'form'=>$form->createView()
        ]);
    }
    
    public function sectorporcliente(){
        
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $data = $this->getDoctrine()->getManager();
        $sectores_cliente = $data->getRepository(ClienteSector::class)->findBy(['id_user'=>$user->getId()]);
        $sectores = array();
        $entityManager = $this->getDoctrine()->getManager();
        foreach($sectores_cliente as $sector){
            array_push($sectores,$entityManager->getRepository(Sector::class)->find($sector->getIdSector()));
        }
        
        return $this->render('sector/cliente_sector.html.twig', [
            'sectores'=>$sectores
        ]);
    }
}
