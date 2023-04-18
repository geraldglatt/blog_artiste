<?php

namespace App\Controller;

use App\Repository\BlogPostRepository;
use App\Repository\PeintureRepository;
use App\Repository\SculptureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name: 'app_')]
class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(
        PeintureRepository $peintureRepository,
        BlogPostRepository $blogPostRepository,
        SculptureRepository $sculptureRepository
    ): Response
    {
        $peinture = $peintureRepository->lastThree();
        $blogPosts = $blogPostRepository->lastThreeBlogPost();
        $sculptures = $sculptureRepository->lastThreeSculpture();

        return $this->render('home/index.html.twig', [
            'peintures' => $peinture,
            'blogposts' => $blogPosts,
            'sculptures' =>$sculptures
        ]);
    }
}
