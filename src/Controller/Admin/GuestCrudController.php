<?php

namespace App\Controller\Admin;

use App\Entity\Main\Guest;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

class GuestCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Guest::class;
    }


    /*    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            TextField::new('first_name'),
            TextField::new('last_name'),
            Field::new('date_of_birth'),
            TextField::new('email'),
            TextField::new('phone'),
        ];
    }
    */
}


