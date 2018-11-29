<?php

namespace App\Form;

use App\Entity\Billet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class BilletType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('typeBillet', ChoiceType::class, [
                'choices' => [
                    'Journée' => 1,
                    'Demi-Journée' => 2,
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('pays', CountryType::class, [
                'preferred_choices' => ['FR'],
            ])
            ->add('dateNaissance', BirthdayType::class)
            ->add('tarifReduit')
            ->add('commande')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Billet::class,
        ]);
    }
}
