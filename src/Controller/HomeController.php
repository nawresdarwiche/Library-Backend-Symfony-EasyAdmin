<?php

namespace App\Controller;

use App\Repository\LivreRepository;
use App\Repository\CategorieRepository;
use App\Repository\EditeurRepository;
use App\Repository\AuteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(
        LivreRepository $livreRepository,
        CategorieRepository $categorieRepository,
        EditeurRepository $editeurRepository,
        AuteurRepository $auteurRepository
    ): Response
    {
        return $this->render('home/index.html.twig', [
            'livres' => $livreRepository->findAll(),
            'categories' => $categorieRepository->findAll(),
            'editeurs' => $editeurRepository->findAll(),
            'auteurs' => $auteurRepository->findAll(),
        ]);
    }
}
