<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\PeintureRepository;
use App\Repository\SculptureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PortfolioController extends AbstractController
{
    #[Route('/portfolio', name: 'app_portfolio')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('portfolio/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/portfolio/{slug}', name: 'app_portfolio_category')]
    public function categorie(
        $slug,
        Category $categorie,
        PeintureRepository $peintureRepository,
        SculptureRepository $sculptureRepository,
        CategoryRepository $categoryRepository
    )
    {
        $category = $categoryRepository->findAll();
        $peintures = $peintureRepository->findAllPortfolio($categorie);
        $sculptures = $sculptureRepository->findAllPortfolio($categorie);

        return $this->render('portfolio/categorie.html.twig', [
            'categorie' => $categorie,
            'peintures' => $peintures,
            '$sculptures' => $sculptures,
            'categoryRepository' => $categoryRepository,
            'category' => $category,
            'slug' => $slug
        ]);
    }
}
