<?php

namespace App\Form;

use App\Entity\Pirkejai;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class BuyersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('vardas')
            ->add('pavarde')
            ->add('telNr')
            ->add('elPastas')
            ->add('adresas', TextareaType::class, [
                'attr' => [
                    'style' => 'width: 1300px; height: 100px',
                ]
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
            'data_class' => Pirkejai::class,
        ]);
    }
}
