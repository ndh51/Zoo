<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\PassageEvenement;
use App\Entity\Ticket;
use App\Entity\Visiteur;
use Doctrine\ORM\EntityRepository;
use PHPUnit\Framework\Constraint\GreaterThan;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketType extends AbstractType
{
    /**
     * @throws \Exception
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $date = new \DateTime($options['date']);
        $nbPers = intval($options['nbPers']);
        $builder
            ->add('dateTicket', DateType::class, [
                'data' => $date,
                'attr' => ['style' => 'display:none;'],
                'label' => false,
            ])
            ->add('prixTicket', IntegerType::class, [
                'data' => 15,
                'attr' => ['style' => 'display:none;'],
                'label' => false,
            ])
            ->add('nbPers', IntegerType::class, [
                'data' => $nbPers,
                'attr' => ['style' => 'display:none;'],
                'label' => false,
            ])
            ->add('visiteur', EntityType::class, [
                'class' => Visiteur::class,
                'choice_label' => 'email',
                'data' => $options['currentVisiteur'],
                'attr' => ['style' => 'display:none;'],
                'label' => false,
            ])
            ->add('vues', EntityType::class, [
                'class' => Animal::class,
                'choice_label' => 'nomAnimal',
                'multiple' => true,
                'expanded' => true,
                'label' => false,
                'mapped' => false,
                'query_builder' => function (EntityRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('a')
                        ->orderBy('a.nomAnimal', 'ASC');
                },
            ])
            ->add('reservationEvenement', EntityType::class, [
                'class' => PassageEvenement::class,
                'choice_label' => function ($passageEvenement) {
                    return $passageEvenement->getEvenement()->getNomEvent().' '.$passageEvenement->getHDebEvenement();
                },
                'multiple' => true,
                'expanded' => true,
                'label' => false,
                'mapped' => false,
                'query_builder' => function (EntityRepository $entityRepository) use ($nbPers, $date) {
                    return $entityRepository->createQueryBuilder('pe')
                                            ->Join('pe.evenement', 'e')
                                            ->andWhere('pe.datePassage = :date')
                                            ->andWhere('pe.nbPlacesRestantes >= :nbPers')
                                            ->orderBy('pe.hDebEvenement', 'ASC')
                                            ->addOrderBy('e.nomEvent', 'ASC')
                                            ->setParameter('date', $date)
                                            ->setParameter('nbPers', $nbPers);
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ticket::class,
            'currentVisiteur' => false,
            'date' => false,
            'nbPers' => false,
        ]);
    }
}
