<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\Evenement;
use App\Entity\ReservationEvenement;
use App\Entity\Ticket;
use App\Entity\Visiteur;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateTicket', DateType::class)
            ->add('prixTicket', IntegerType::class, [
                'data' => 15,
                'attr' => ['style' => 'display:none;'],
                'label' => false,
            ])
            ->add('visiteur', EntityType::class, [
                'class' => Visiteur::class,
                'choice_label' => 'id',
                'data' => $options['currentVisiteur'],
                'attr' => ['style' => 'display:none;'],
                'label' => false,
            ])
            ->add('vues', EntityType::class, [
                'class' => Animal::class,
                'choice_label' => 'nomAnimal',
                'multiple' => true,
                'expanded' => true,
                'label' => 'Animaux',
                'query_builder' => function (EntityRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('a')
                        ->orderBy('a.nomAnimal', 'ASC');
                },
            ])
            ->add('reservationEvenement', EntityType::class, [
                'class' => Evenement::class,
                'choice_label' => 'nomEvent',
                'multiple' => true,
                'expanded' => true,
                'label' => 'Evenements',
                'query_builder' => function (EntityRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('e')
                        ->orderBy('e.nomEvent', 'ASC');
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ticket::class,
            'currentVisiteur' => false,
        ]);
    }
}
