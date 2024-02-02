<?php

namespace App\Controller\Admin;

use App\Entity\Adopt;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class AdoptCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Adopt::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            MoneyField::new('money')->setLabel('Donation')->setCurrency('EUR'),
            DateField::new('date')->setLabel('Date du parrainage'),
            AssociationField::new('user')
            ->autocomplete()
            ->formatValue(function ($value, $entity) {
                // Utiliser $value->getLastname() si 'user' est une entité User
                return $value->getLastName();
            }),
        AssociationField::new('orangoutan')
            ->autocomplete()
            ->formatValue(function ($value, $entity) {
                // Utiliser $value->getName() si 'orangoutan' est une entité OrangOutan
                return $value->getName();
            }),
        ];
    }
}
