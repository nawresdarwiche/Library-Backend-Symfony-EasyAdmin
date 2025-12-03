<?php

namespace App\Controller\Admin;

use App\Entity\Editeur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class EditeurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Editeur::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // ID
            IdField::new('id')
                ->hideOnForm(), // cacher sur les formulaires

            // Nom de l'éditeur
            TextField::new('nomEditeur', 'Nom de l’éditeur'),

            // Pays
            TextField::new('pays', 'Pays'),

            // Adresse
            TextField::new('adresse', 'Adresse'),

            // Téléphone
            TextField::new('telephone', 'Téléphone'),

            // Image (nullable)
            ImageField::new('image', 'Logo / Image')
                ->setBasePath('uploads/images')      // chemin pour affichage
                ->setUploadDir('public/uploads/images') // chemin pour upload
                ->setUploadedFileNamePattern('[slug]-[uuid].[extension]')
                ->setRequired(false),
        ];
    }
}
