<?php

namespace App\Controller\Admin;

use App\Entity\OrangOutan;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class OrangOutanCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OrangOutan::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')
            ->setLabel('Nom'),
            DateTimeField::new('birth')
            ->setFormat('dd/MM/yyyy')
            ->setLabel('Date de naissance'),
            TextEditorField::new('story')
            ->setLabel('Leur histoire'),
            ImageField::new('picture')
            ->setBasePath('uploads/images/pictures/')
            ->setUploadDir('public/uploads/images/pictures/')
            ->setLabel('Photo'),
        ];
    }
}
