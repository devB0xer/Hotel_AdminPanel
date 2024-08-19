<?php

namespace App\Controller\Admin;

use App\Entity\Main\ServicePrice;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class ServicePriceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ServicePrice::class;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            AssociationField::new('service'),
            MoneyField::new('price')->setCurrency('RUB'),
            Field::new('start_date'),
            Field::new('end_date'),
            Field::new('is_default')
        ];
    }
}
