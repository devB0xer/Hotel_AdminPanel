<?php

namespace App\Controller\Admin;

use App\Entity\Main\RoomServiceOrder;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use App\Config\OrderStatus;

class RoomServiceOrderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RoomServiceOrder::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            AssociationField::new('booking'),
            AssociationField::new('room_service'),
            Field::new('request_date'),
            Field::new('completion_date'),
            AssociationField::new('employee'),
            ChoiceField::new('status')->setChoices(OrderStatus::cases()),
        ];
    }
}
