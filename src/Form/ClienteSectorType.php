<?php

namespace App\Form;

use App\Entity\ClienteSector;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\User;
use App\Entity\Sector;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class ClienteSectorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id_user',EntityType::class,[
                'class' => User::class,
                'label'=>'Cliente',
                'placeholder'=>'Seleccionar...',                
                'choice_label' => function(User $user) {
                    return sprintf($user->getNombre());
                },
                'query_builder' => function (EntityRepository $usuario) {
                    return $usuario->createQueryBuilder('u')
                        ->andWhere('u.roles LIKE :role')
                        ->setParameter('role', '%"'."ROLE_CLIENTE".'"%');
                },
                ])
            ->add('id_sector',EntityType::class,[
                'class' => Sector::class,
                'label'=>'Sector',
                'placeholder'=>'Seleccionar...',
                'choice_label' => function(Sector $sector) {
                    return sprintf($sector->getNombre());
                }
                ])
                ->add('Guardar', SubmitType::class,['attr'=>['class'=>'btn btn-success']])
                ->add('Cancelar', ButtonType::class,['attr'=>['class'=>'btn btn-danger']]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ClienteSector::class,
        ]);
    }
}
