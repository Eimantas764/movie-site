<?php

namespace App\Form;

use App\Entity\Vaidinimai;
use App\Entity\Filmai;
use App\Entity\Aktoriai;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PerformancesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fk_Filmasid', EntityType::class, [
                // looks for choices from this entity
                'class' => Filmai::class,          
                'choice_label' => 'pavadinimas',
                'label' => 'Filmas'
            ])
            ->add('fk_Aktoriusid', EntityType::class, [
                // looks for choices from this entity
                'class' => Aktoriai::class,          
                'choice_label' => 'vardas',
                'label' => 'Aktorius'
            ])
            ->add('Save', SubmitType::class, [                 
                'attr' => [
                    'class' => 'button',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vaidinimai::class,
        ]);
    }
}
