<?php

namespace App\Controller;
use App\Repository\CategorieRepository;
use App\Repository\LivreRepository;
use App\Repository\EditeurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AccueilController extends AbstractController
{
     #[Route('/accueil', name: 'app_accueil')]
    public function index(CategorieRepository $catRepo, EditeurRepository $edRepo, LivreRepository $livreRepo)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN'); // page admin only
        $categories = $catRepo->findAll();
        $editeurs = $edRepo->findAll();
        $livres = $livreRepo->findBy([], ['id' => 'DESC'], 8);
        return $this->render('accueil/index.html.twig', compact('categories','editeurs','livres'));
    }
}
