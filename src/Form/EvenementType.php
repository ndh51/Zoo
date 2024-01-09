<?php

namespace App\Form;

use App\Entity\Enclos;
use App\Entity\Evenement;
use App\Entity\Image;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomEvent', TextType::class, ['empty_data' => '', 'label' => 'Nom de l\'évènement '])
            ->add('descEvent', TextareaType::class, ['empty_data' => '', 'label' => 'Description de l\'évènement '])
            ->add('nbPlaceMaxEvent', IntegerType::class, ['label' => 'Nombre de places maximum '])
            ->add('enclos', EntityType::class, [
                'required' => false,
                'class' => Enclos::class,
                'choice_label' => 'nomEnclos',
                'label' => 'Enclos ',
                'query_builder' => function (EntityRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('c')
                        ->orderBy('c.nomEnclos', 'ASC');
                },
            ]
            )
            ->add('duree', IntegerType::class, ['label' => 'Durée'])
            ->add('image', EntityType::class, [
                'class' => Image::class,
                'choice_label' => 'id',
                'label' => 'L\'image attribuée à cet évènement sera l\'image par défaut ',
                'data' => $options['default_image'],
                'attr' => ['style' => 'display:none;'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
            'default_image' => null,
        ]);
    }
}
