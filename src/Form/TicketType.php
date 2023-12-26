<?php

namespace App\Form;

use App\Entity\Ticket;
use App\Entity\Visiteur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateTicket')
            ->add('prixTicket')
            ->add('visiteur', EntityType::class, [
                'class' => Visiteur::class,
                'choice_label' => 'id',
                // 'attr' => ['style' => 'display:none;'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ticket::class,
        ]);
    }
}
