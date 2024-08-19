<?php

namespace App\Controller\Admin;

use App\Entity\Main\RoomPrices;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

class RoomPricesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RoomPrices::class;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            AssociationField::new('room'),
            MoneyField::new('price')->setCurrency('RUB'),
            Field::new('start_date'),
            Field::new('end_date'),
            Field::new('is_default')
        ];
    }
}
