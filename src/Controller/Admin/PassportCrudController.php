<?php

namespace App\Controller\Admin;

use App\Entity\Main\Passport;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;


class PassportCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Passport::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            AssociationField::new('guest'),
            TextField::new('type'),
            TextField::new('number'),
            Field::new('issue_date'),
            TextField::new('issuing_country'),
        ];
    }

}
