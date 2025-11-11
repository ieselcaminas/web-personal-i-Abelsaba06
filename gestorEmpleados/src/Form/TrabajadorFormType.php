<?php

namespace App\Form;

use App\Entity\Empresa;
use App\Entity\Trabajador;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TrabajadorFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('telefono')
            ->add('edad')
            ->add('cotizacion')
            ->add('salario')
            ->add('puesto')
            ->add('empresa', EntityType::class, [
                'class' => Empresa::class,
                'choice_label' => 'nombre',
            ])
            ->add('save', SubmitType::class, array('label' => 'Enviar'));
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Trabajador::class,
        ]);
    }
}
