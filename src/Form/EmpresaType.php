<?php

namespace App\Form;

use App\Entity\Empresa;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Sector;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;

class EmpresaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('telefono')
            ->add('email', EmailType::class,['invalid_message'=>'El email es invalido'])
            ->add('sector', EntityType::class,[
                'class' => Sector::class,
                'placeholder'=>'Seleccionar...',
                'choice_label' => function(Sector $sector) {
                    return sprintf($sector->getNombre());
                }
                ])
            ->add('Guardar',SubmitType::class)
            ->add('Cancelar', ButtonType::class,['attr'=>['class'=>'btn btn-danger']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Empresa::class,
        ]);
    }
}
