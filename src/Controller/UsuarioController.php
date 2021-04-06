<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsuarioController extends AbstractController
{
    /**
     * @Route("/usuario", name="index")
     */
    public function index(): Response
    {
        $data = $this->getDoctrine()->getRepository(User::class);
        $usuarios = $data->findAll();
        return $this->render('usuario/index.html.twig', [
            'usuarios'=>$usuarios
        ]);
    }
    
    
     /**
     * @Route("/usuario/altaCliente", name="altaCliente")
     */
    public function altaCliente(Request $request,UserPasswordEncoderInterface $passwordEncoder){
         
        $user = new User();
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
             $data = $this->getDoctrine()->getManager();
             $user->setRoles(['ROLE_CLIENTE']);
             $user->setPassword($passwordEncoder->encodePassword($user, $form['password']->getData()));
             $data->persist($user);
             $data->flush();
             
             $this->addFlash('success', 'Se creo el usuario correctamente');
            return $this->redirectToRoute('usuario');
        }
        
        return $this->render('usuario/alta.html.twig',[
            'form'=>$form->createView(),
            'user_type'=>'Cliente'
        ]);
    }
    
     /**
     * @Route("/usuario/altaAdmin", name="altaAdmin")
     */
    public function altaAdmin(Request $request,UserPasswordEncoderInterface $passwordEncoder){
         
        $user = new User();
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
             $data = $this->getDoctrine()->getManager();
             $user->setRoles(['ROLE_ADMIN']);
             $user->setPassword($passwordEncoder->encodePassword($user, $form['password']->getData()));
             $data->persist($user);
             $data->flush();
             
             $this->addFlash('success', 'Se creo el usuario correctamente');
            return $this->redirectToRoute('usuario');
        }
        
        return $this->render('usuario/alta.html.twig',[
            'form'=>$form->createView(),
            'user_type'=>'Administrador'
        ]);
    }
    
    /**
     * @Route("/usuario/update", name="update")
     * 
     */
    public function update(int $id, Request $request){
                        
        $usuario = $this->getDoctrine()->getRepository(User::class)->find($id);
        $form = $this->createForm(UserType::class,$usuario);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

             $data = $this->getDoctrine()->getManager();
             $data->persist($usuario);
             $data->flush();
             
             $this->addFlash('success', 'Se actualizo el usuario exitosamente');
            return $this->redirectToRoute('usuario');
        }
        
        return $this->render('usuario/editar.html.twig',[
            'form'=>$form->createView()
        ]);
    }
    
    /**
     * @Route("/usuario/delete", name="delete")
     * 
     */
    public function delete(int $id){
        
        $entityManager = $this->getDoctrine()->getManager();
        $usuario = $entityManager->getRepository(User::class)->find($id);
        $sector_cliente = $entityManager->getRepository(\App\Entity\ClienteSector::class)->findBy(['id_user'=>$id]);
        
        if($id == $this->getUser()->getId()){
            $this->addFlash('error', 'No se puede eliminar el usuario de la sesion actual.');
            return $this->redirectToRoute('usuario');
        }
        
        if($sector_cliente){
            $this->addFlash('error', 'No se puede eliminar un usuario con sectores asociados.');
            return $this->redirectToRoute('usuario');
        }
        
        $entityManager->remove($usuario);
        $entityManager->flush();
        
        $this->addFlash('success', 'Se elimino el usuario exitosamente');
        return $this->redirectToRoute('usuario');
                
    }
}
