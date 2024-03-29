<?php

namespace App\Controller\Admin;

use App\Entity\Animal;
use Doctrine\ORM\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

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
            AssociationField::new('famille', 'Famille')
            ->setFormTypeOptions(['choice_label' => 'nomFamille',
                'label' => 'Famille',
                'query_builder' => function (EntityRepository $entityRepository) {
                    return $entityRepository->createQueryBuilder('f')
                        ->orderBy('f.nomFamille', 'ASC');
                }, ])
                ->formatValue(function ($value, $entity) {
                    return $entity->getFamille()?->getNomFamille();
                }),
            AssociationField::new('categorie', 'Catégorie')
                ->setFormTypeOptions(['choice_label' => 'nomCategorie',
                    'label' => 'Catégorie',
                    'query_builder' => function (EntityRepository $entityRepository) {
                        return $entityRepository->createQueryBuilder('c')
                            ->orderBy('c.nomCategorie', 'ASC');
                    }, ])
                ->formatValue(function ($value, $entity) {
                    return $entity->getCategorie()?->getNomCategorie();
                }),
            AssociationField::new('enclos', 'Enclos')
                ->setFormTypeOptions(['choice_label' => 'nomEnclos',
                    'label' => 'Enclos',
                    'query_builder' => function (EntityRepository $entityRepository) {
                        return $entityRepository->createQueryBuilder('e')
                            ->orderBy('e.nomEnclos', 'ASC');
                    }, ])
                ->formatValue(function ($value, $entity) {
                    return $entity->getenclos()?->getNomEnclos();
                }),
            AssociationField::new('image', 'Image')
                ->setFormTypeOptions(['choice_label' => 'pathImage',
                    'label' => 'Image', ])
                ->formatValue(function ($value, $entity) {
                    return $entity->getImage()?->getPathImage();
                }),
        ];
    }
}
