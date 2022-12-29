<?php

namespace App\Controller;

use App\Entity\Sculpture;
use App\Repository\SculptureRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SculptureController extends AbstractController
{
    #[Route('/sculpture', name: 'app_sculpture')]
    public function sculpture(
        SculptureRepository $sculptureRepository,
        Request $request,
        PaginatorInterface $paginatorInterface
    ): Response {
        $datas = $sculptureRepository->findBy([], ['createdAt' => 'DESC']);

        $sculptures = $paginatorInterface->paginate(
            $datas,
            $request->query->getInt('Page', 1),
            3
        );

        return $this->render('sculpture/index.html.twig', [
            'sculptures' => $sculptures,
        ]);
    }

    #[Route('/sculpture/{slug}', name: 'app_sculpture_realisation')]
    public function details(Sculpture $sculpture): Response
    {
        return $this->render('sculpture/details.html.twig', [
            'sculpture' => $sculpture
        ]);
    }
}
