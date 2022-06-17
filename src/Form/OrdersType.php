<?php

namespace App\Form;

use App\Entity\Uzsakymai;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Pirkejai;
use App\Entity\Filmai;
use App\Form\BuyersType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class OrdersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fkFilmasid', EntityType::class, [
                // looks for choices from this entity
                'class' => Filmai::class,          
                // uses the User.username property as the visible option string
                'choice_label' => 'pavadinimas',
                'label' => 'Filmas'
            ])
            ->add('fkPirkejasid', EntityType::class, [
                // looks for choices from this entity
                'class' => Pirkejai::class,          
                // uses the User.username property as the visible option string
                'choice_label' => 'elPastas',
                'label' => 'Pirkėjas'
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
            'data_class' => Uzsakymai::class,
        ]);
    }
}
