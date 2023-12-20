<?php

namespace App\Form;

use App\Entity\Evenement;
use App\Entity\PassageEvenement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PassageEvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('hDebEvenement', TextType::class, ['label' => 'H de l\'évènement '])
            ->add('Evenement', EntityType::class, [
                'class' => Evenement::class,
                'choice_label' => 'nomEvent',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PassageEvenement::class,
        ]);
    }
}
