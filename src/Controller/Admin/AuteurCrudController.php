<?php

namespace App\Controller\Admin;

use App\Entity\Auteur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class AuteurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Auteur::class;
    }

     public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('prenom', 'Prénom'),
            TextField::new('nom', 'Nom'),
            TextEditorField::new('biographie', 'Biographie')->hideOnIndex(),
            ImageField::new('image', 'Photo de l’auteur')
                ->setBasePath('uploads/images')       // chemin pour afficher
                ->setUploadDir('public/uploads/images') // chemin pour uploader
                ->setRequired(false),                  // pas obligatoire
        ];
    }
}
