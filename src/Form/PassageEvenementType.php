<?php

namespace App\Form;

use App\Entity\Evenement;
use App\Entity\PassageEvenement;
use Doctrine\DBAL\Types\Types;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;

class PassageEvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('hDebEvenement', TextType::class, [
                'label' => 'H de l\'évènement ',
                'constraints' => [
                    new Regex([
                        'pattern' => '/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/',
                        'message' => 'Le format doit être H:i (heures:minutes)',
                    ]),
                ],
            ])
            ->add('datePassage', DateType::class, ['label' => 'Date de l\'évènement'])
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
