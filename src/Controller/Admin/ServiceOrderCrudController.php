<?php

namespace App\Controller\Admin;

use App\Entity\Main\ServiceOrder;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class ServiceOrderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ServiceOrder::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            AssociationField::new('booking'),
            AssociationField::new('service'),
            Field::new('quantity'),
        ];
    }
}
