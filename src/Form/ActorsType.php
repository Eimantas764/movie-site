<?php

namespace App\Form;

use App\Entity\Aktoriai;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ActorsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('vardas', null, [
                'attr' => [
                    'placeholder' => 'Įveskite vardą',
                    'class' => 'input'
                ]
            ])
            ->add('pavarde', null, [
                'attr' => [
                    'placeholder' => 'Įveskite pavardę',
                ]
            ])
            ->add('gimData', DateType::class, [
                'widget' => 'single_text'
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
            'data_class' => Aktoriai::class,
        ]);
    }
}
