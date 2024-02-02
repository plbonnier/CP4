<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FileField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('email'),
            ArrayField::new('roles'),
            TextField::new('password')->hideOnIndex(),
            TextField::new('lastname')->setLabel('Nom de famille'),
            TextField::new('firstname')->setLabel('Prénom'),
            TextField::new('adress')->setLabel('Adresse'),
            TextField::new('zipcode')->setLabel('Code postal'),
            TextField::new('city')->setLabel('Ville'),
            TextField::new('country')->setLabel('Pays'),
            BooleanField::new('rgpd'),
            ImageField::new('picture')
                ->setBasePath('uploads/images/pictures/')
                ->setUploadDir('public/uploads/images/pictures/')
                ->setLabel('Photo')
        ];
    }
}
