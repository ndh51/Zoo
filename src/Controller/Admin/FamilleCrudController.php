<?php

namespace App\Controller\Admin;

use App\Entity\Famille;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FamilleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Famille::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nomFamille', 'Famille'),
            TextField::new('descFamille', 'Description'),

        ];
    }

}
