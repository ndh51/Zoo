<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\Categorie;
use App\Entity\Enclos;
use App\Entity\Famille;
use App\Entity\Image;
use App\Repository\ImageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomAnimal', TextType::class, ['empty_data' => '', 'label' => 'Nom de l\'Animal '])
            ->add('descAnimal', TextareaType::class, ['empty_data' => '', 'label' => 'Description de l\'Animal '])
            ->add('famille', EntityType::class, [
                'required' => true,
                'class' => Famille::class,
                'choice_label' => 'nomFamille',
                'label' => 'Famille ',
                'query_builder' => function (EntityRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('c')
                        ->orderBy('c.nomFamille', 'ASC');
                },
            ])
            ->add('categorie', EntityType::class, [
                    'required' => true,
                    'class' => Categorie::class,
                    'choice_label' => 'nomCategorie',
                    'label' => 'Categorie ',
                    'query_builder' => function (EntityRepository $entityRepository) {
                        return $entityRepository->createQueryBuilder('c')
                            ->orderBy('c.nomCategorie', 'ASC');
                    },
                ]
            )
            ->add('enclos', EntityType::class, [
                    'required' => true,
                    'class' => Enclos::class,
                    'choice_label' => 'nomEnclos',
                    'label' => 'Enclos ',
                    'query_builder' => function (EntityRepository $entityRepository) {
                        return $entityRepository->createQueryBuilder('e')
                            ->orderBy('e.nomEnclos', 'ASC');
                    },
                ]
            )
            ->add('image', EntityType::class, [
                'class' => Image::class,
                'choice_label' => 'id',
                'label' => 'L\'image attribuée à cet animal sera l\'image par défaut ',
                'data' => $options['default_image'],
                'attr' => ['style' => 'display:none;'],
            ])
        ;
    }
    

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
            'default_image' => null,
        ]);
    }
}
