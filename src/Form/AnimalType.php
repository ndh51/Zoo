<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\Categorie;
use App\Entity\Famille;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomAnimal', TextType::class, ['empty_data' => '', 'label' => 'Nom de l\'Animal '])
            ->add('descAnimal', TextType::class, ['empty_data' => '', 'label' => 'Description de l\'Animal '])
            ->add('idFamille', EntityType::class, [
                'required' => true,
                'class' => Famille::class,
                'choice_label' => 'nomFamille',
                'label' => 'Famille ',
                'query_builder' => function (EntityRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('c')
                        ->orderBy('c.nomFamille', 'ASC');
                },
            ])
            ->add('idCategorie', EntityType::class, [
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
        ]);
    }
}
