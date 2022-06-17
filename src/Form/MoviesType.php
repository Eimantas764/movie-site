<?php

namespace App\Form;

use App\Entity\Filmai;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class MoviesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pavadinimas')
            ->add('imdb')
            ->add('metai')
            ->add('kaina')
            ->add('paveikslelis', FileType::class, array('data_class' => null, 'required' => false))
            ->add('zanras', ChoiceType::class , [
                'choices'  => [
                    'Drama' => 'drama',
                    'Trileris' => "trileris",
                    'Veiksmo' => 'veiksmo',
                    'Siaubo' => 'siaubo',
                    'Nuotykių' => 'nuotykiu',
                    'Komedija' => 'komedija'
                ],
                'data_class' => null
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
            'data_class' => Filmai::class,
        ]);
    }
}
