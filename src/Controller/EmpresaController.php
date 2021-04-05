<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Empresa;
use App\Form\EmpresaType;
use Symfony\Component\HttpFoundation\Request;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Entity\ClienteSector;
use App\Entity\Sector;
class EmpresaController extends AbstractController
{
    /**
     * @Route("/empresa", name="empresa")
     * 
     */
    public function index($page=1)
    {
       
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        if($this->isGranted('ROLE_CLIENTE')){
            return $this->redirectToRoute('empresa_cliente');
        }        
        $data = $this->getDoctrine()->getRepository(Empresa::class);
        $query = $data->findAll();
                
        return $this->render('empresa/index.html.twig', [
            'controller_name' => 'Empresas',
            'empresas'=>$query
        ]);
    }
    
    /**
     * @Route("/empresa/new", name="new")
     * @IsGranted("ROLE_ADMIN")
     */
    public function new(Request $request){
                
        
        $this->denyAccessUnlessGranted('ROLE_ADMIN',null,'No tiene los permisos suficientes para ingresar a esta seccion.');
    
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
     * @IsGranted("ROLE_ADMIN")
     */
    public function update(int $id, Request $request){
                
        $this->denyAccessUnlessGranted('ROLE_ADMIN',null,'No tiene los permisos suficientes para ingresar a esta seccion.');
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
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(int $id){
        $this->denyAccessUnlessGranted('ROLE_ADMIN',null,'No tiene los permisos suficientes para ingresar a esta seccion.');        
        $entityManager = $this->getDoctrine()->getManager();
        $empresa = $entityManager->getRepository(Empresa::class)->find($id);
        $entityManager->remove($empresa);
        $entityManager->flush();
        $this->addFlash('success', 'Se elimino la empresa exitosamente');
        return $this->redirectToRoute('empresa');
                
    }
    
    
    /**
     * @Route("/empresa/empresaporcliente", name="empresaporcliente")
     * 
     */
    public function empresaporcliente(){
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $data = $this->getDoctrine()->getManager();
        $sectores = $data->getRepository(ClienteSector::class)->findBy(['id_user'=>$user->getId()]);
        $empresas = array();
        foreach($sectores as $sector){
            $registros = $data->getRepository(Empresa::class)->findBy(['sector'=>$sector->getIdSector()]);
            if($registros > 1){
                foreach($registros as $registro){
                    array_push($empresas,$registro);
                }
            }else{
                    array_push($empresas,$registros);
            }
            
        }
         return $this->render('empresa/cliente_empresa.html.twig', [
            'sectores'=>$sectores,
            'empresas'=>$empresas
        ]);
    }
    
    
}
