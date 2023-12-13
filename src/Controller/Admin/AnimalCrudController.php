<?php

namespace App\Controller\Admin;

use App\Entity\Animal;
use Doctrine\ORM\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Faker\Provider\Text;

class AnimalCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Animal::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nomAnimal', 'Animal'),
            TextField::new('descAnimal', 'Description'),
            AssociationField::new('idFamille', 'Famille')
            ->setFormTypeOptions(['choice_label' => 'nomFamille',
                'label' => 'Famille',
                'query_builder' => function (EntityRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('f')
                        ->orderBy('f.nomFamille', 'ASC');
                }, ])
                ->formatValue(function ($value, $entity) {
                    return $entity->getIdFamille()?->getNomFamille();
                }),
            AssociationField::new('idCategorie', 'Catégorie')
                ->setFormTypeOptions(['choice_label' => 'nomCategorie',
                    'label' => 'Catégorie',
                    'query_builder' => function (EntityRepository $entityRepository) {
                        return $entityRepository->createQueryBuilder('c')
                            ->orderBy('c.nomCategorie', 'ASC');
                    }, ])
                ->formatValue(function ($value, $entity) {
                    return $entity->getIdCategorie()?->getNomCategorie();
                }),
        ];
    }
}
