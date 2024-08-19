<?php

namespace App\Controller\Admin;

use App\Entity\Main\Employee;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

class EmployeeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Employee::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            Field::new('first_name'),
            Field::new('last_name'),
            AssociationField::new('position'),
            Field::new('phone'),
            Field::new('email'),
        ];
    }
}
