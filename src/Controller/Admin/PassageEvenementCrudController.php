<?php

namespace App\Controller\Admin;

use App\Entity\PassageEvenement;
use Doctrine\ORM\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PassageEvenementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PassageEvenement::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('hDebEvenement'),
            DateField::new('datePassage'),
            AssociationField::new('evenement')
                ->setFormTypeOptions([
                    'choice_label' => 'nomEvent',
                    'query_builder' => function (EntityRepository $entityRepository) {
                        return $entityRepository->createQueryBuilder('e')
                            ->orderBy('e.nomEvent', 'ASC');
                    },
                ])
                ->formatValue(function ($value, $entity) {
                    return $entity->getEvenement()->getNomEvent();
                }),
        ];
    }
}
