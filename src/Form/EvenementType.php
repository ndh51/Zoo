<?php

namespace App\Form;

use App\Entity\Enclos;
use App\Entity\Evenement;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomEvent', TextType::class, ['empty_data' => ''])
            ->add('descEvent', TextType::class, ['empty_data' => ''])
            ->add('nbPlaceMaxEvent', IntegerType::class, ['empty_data' => 3])
            ->add('idEnclos', EntityType::class, [
                'required' => false,
                'class' => Enclos::class,
                'choice_label' => 'nomEnclos',
                'query_builder' => function (EntityRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('c')
                        ->orderBy('c.nomEnclos', 'ASC');
                },
            ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
