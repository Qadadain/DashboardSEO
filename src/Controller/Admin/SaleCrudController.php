<?php

namespace App\Controller\Admin;

use App\Entity\Sale;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class SaleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Sale::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            UrlField::new('link', 'Liens de l\'article :'),
            TextField::new('saleNumber', 'Numéro de vente :'),
            UrlField::new('target', 'Cible :'),
            IntegerField::new('price', 'Prix :'),
            DateField::new('date', 'Date :'),
            AssociationField::new('customer', 'Client :'),
            AssociationField::new('domainName', 'Nom de domaine :'),
            AssociationField::new('user', 'Titulaire :'),
        ];
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud

            ->setSearchFields(['id','link', 'target', 'saleNumber', 'price','date','customer.name', 'domainName.name','user.pseudo']);
    }
}
