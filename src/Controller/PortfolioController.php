<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Peinture;
use App\Entity\Sculpture;
use App\Repository\CategoryRepository;
use App\Repository\PeintureRepository;
use App\Repository\SculptureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PortfolioController extends AbstractController
{
    #[Route('/portfolio', name: 'app_portfolio')]
    public function index(
        CategoryRepository $categoryRepository,
    ): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('portfolio/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/portfolio/{slug}', name: 'app_portfolio_category')]
    public function categorie(
        $slug,
        Category $category,
        PeintureRepository $peintureRepository,
        SculptureRepository $sculptureRepository,
        CategoryRepository $categoryRepository
    )
    {
        $categorie = $categoryRepository->findAll();
        $peintures = $peintureRepository->findAllPortfolio($category);
        $sculptures = $sculptureRepository->findAllPortfolio($category);

        return $this->render('portfolio/categorie.html.twig', [
            'category' => $category,
            'peintures' => $peintures,
            'sculptures' => $sculptures,
            'categorie' => $categorie,
            'slug' => $slug
        ]);
    }
}
