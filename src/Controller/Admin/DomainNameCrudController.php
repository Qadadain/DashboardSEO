<?php

namespace App\Controller\Admin;

use App\Entity\DomainName;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DomainNameCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DomainName::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nom :'),
            TextField::new('localisation', 'Registrar :'),
            DateField::new('expirationDate', 'Date d\'expiration :'),
            AssociationField::new('holder', 'Titulaire :'),
        ];
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud

            ->setSearchFields(['id', 'name', 'localisation', 'expirationDate', 'holder.pseudo']);
    }
}
