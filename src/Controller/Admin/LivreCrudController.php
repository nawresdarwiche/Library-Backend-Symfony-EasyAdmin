<?php

namespace App\Controller\Admin;

use App\Entity\Livre;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LivreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Livre::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre', 'Titre du livre'),

            ImageField::new('image')
                ->setBasePath('uploads/images')
                ->setUploadDir('public/uploads/images')
                ->setLabel('Image du livre')
                ->setRequired(false),

            IntegerField::new('nbPages', 'Nombre de pages'),
            TextField::new('dateEdition', 'Date d’édition')->hideOnIndex(),
            IntegerField::new('nbExemplaires', 'Nombre d\'exemplaires'),
            MoneyField::new('prix', 'Prix')->setCurrency('EUR'),
            TextField::new('isbn', 'ISBN'),
            AssociationField::new('editeur', 'Éditeur'),
            AssociationField::new('categorie', 'Catégorie'),
            AssociationField::new('auteurs', 'Auteurs'),

            // Champ VichUploader pour le fichier
            TextField::new('fichier')
                ->onlyOnIndex()
                ->formatValue(function ($value, $entity) {
                    return $value
                        ? '<a href="/uploads/files/'.$value.'" target="_blank">Télécharger / Lire</a>'
                        : '';
                })
                ->renderAsHtml(),

            TextField::new('fichierFile', 'Fichier du livre (PDF/EPUB)')
                ->setFormType(VichFileType::class)
                ->onlyOnForms()
                ->setFormTypeOptions([
                    'allow_delete' => true,
                    'download_label' => true,
                    'download_uri' => true,
                    'attr' => ['accept' => '.pdf,.epub'],
                ]),
        ];
    }

    // Route pour lire le livre directement
    #[Route('/livre/lire/{id}', name: 'livre_read')]
    public function read(Livre $livre)
    {
        if (!$livre->getFichier()) {
            throw $this->createNotFoundException('Le fichier du livre n’existe pas.');
        }

        return $this->render('livre/read.html.twig', [
            'livre' => $livre,
        ]);
    }

    // Route pour l’aperçu rapide
    #[Route('/livre/preview/{id}', name: 'livre_preview')]
    public function preview(Livre $livre)
    {
        return $this->render('livre/preview.html.twig', [
            'livre' => $livre,
        ]);
    }
}
