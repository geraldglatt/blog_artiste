<?php

namespace App\Controller;

use App\Entity\Peinture;
use App\Repository\PeintureRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PeintureController extends AbstractController
{
    #[Route('/peintures', name: 'app_peintures')]
    public function realisations(
        PeintureRepository $peintureRepository,
        PaginatorInterface $paginator,
        Request $request
        ): Response {
        $data = $peintureRepository->findBy([], ['createdAt' => 'DESC']);

        $peintures = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            3
        );

        return $this->render('peinture/realisations.html.twig', [
            'peintures' => $peintures,
            
        ]);
    }
    
    #[Route('/peinture/{slug}', name: 'app_peintures_realisations')]
    public function details(Peinture $peinture): Response 
    {
        return $this->render('peinture/details.html.twig', [
            'peinture' => $peinture
        ]);
    }
}
