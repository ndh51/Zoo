<?php

namespace App\Controller\Admin;

use App\Entity\Evenement;
use Doctrine\ORM\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EvenementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Evenement::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nomEvent', 'Evenement'),
            TextField::new('descEvent', 'Description'),
            IntegerField::new('nbPlaceMaxEvent', 'Nombre de place max'),
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
