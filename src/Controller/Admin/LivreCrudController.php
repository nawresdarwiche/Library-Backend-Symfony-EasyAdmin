<?php

namespace App\Controller\Admin;

use App\Entity\Livre;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;


class LivreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Livre::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $fields = [
            TextField::new('titre', 'Titre du livre'),
             ImageField::new('image')
            ->setBasePath('uploads/images')
            ->setUploadDir('public/uploads/images')
            ->setLabel('Image du livre')
            ->setRequired(false), // <--- affichage aussi sur index
            IntegerField::new('nbPages', 'Nombre de pages'),
            TextField::new('dateEdition', 'Date d’édition')->hideOnIndex(),


            IntegerField::new('nbExemplaires', 'Nombre d\'exemplaires'),
            MoneyField::new('prix', 'Prix')->setCurrency('EUR'),
            TextField::new('isbn', 'ISBN'),
            AssociationField::new('editeur', 'Éditeur'),
            AssociationField::new('categorie', 'Catégorie'),
            AssociationField::new('auteurs', 'Auteurs'),
            
        ];


        return $fields;
    }
}
