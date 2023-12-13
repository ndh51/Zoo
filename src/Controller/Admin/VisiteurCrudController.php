<?php

namespace App\Controller\Admin;

use App\Entity\Visiteur;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Faker\Provider\Text;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class VisiteurCrudController extends AbstractCrudController
{

    private UserPasswordHasherInterface $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public static function getEntityFqcn(): string
    {
        return Visiteur::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            EmailField::new('email'),
            TextField::new('password')->setFormTypeOption('attr', ['autocomplete' => 'off',
                'required' => false,
                'empty_data' => '',
                'auto_complete' => 'off']),
            TextField::new('nomVisiteur', 'Nom'),
            TextField::new('adVisiteur', 'Adresse'),
            TextField::new('villeVisiteur', 'Ville'),
            TextField::new('CpVisiteur', 'CP'),
            TextField::new('telVisiteur', 'Tel'),
            ArrayField::new('roles')->formatValue(function ($value, $entity) {
                if (in_array('ROLE_ADMIN', $entity->getRoles())) {
                    return '<span class="material-symbols-outlined">manage_accounts</span>';
                } elseif (in_array('ROLE_USER', $entity->getRoles())) {
                    return '<span class="material-symbols-outlined">person</span>';
                } else {
                    return '';
                }
            }),
        ];
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $this->setVisiteurPassword($entityInstance, $entityManager);
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $this->setVisiteurPassword($entityInstance, $entityManager);
        parent::persistEntity($entityManager, $entityInstance);
    }

    public function setVisiteurPassword($entityInstance, EntityManagerInterface $entityManager): void
    {
        $pwd = $this->getContext()->getRequest()->get('Visiteur')['password'];
        if ($pwd) {
            $entityInstance->setPassword($this->userPasswordHasher->hashPassword($entityInstance, $pwd));
        }

        parent::updateEntity($entityManager, $entityInstance);
    }

    public function configureAssets(Assets $assets): Assets
    {
        return $assets->addHtmlContentToHead('<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />');
    }
}
