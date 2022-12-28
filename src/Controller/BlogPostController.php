<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Repository\BlogPostRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogPostController extends AbstractController
{
    #[Route('/actualites', name: 'app_actualites')]
    public function actualites(BlogPostRepository $blogPostRepository,
    PaginatorInterface $paginatorInterface,
    Request $request)
    : Response
    {
        $datas = $blogPostRepository->findBy([], ['createdAt' => 'DESC']);

        $actualites = $paginatorInterface->paginate(
            $datas,
            $request->query->getInt('page', 1),
            3
        );

        return $this->render('blogpost/actualites.html.twig', [
            'actualites' => $actualites,
        ]);
    }

    #[Route('/actualites/{slug}', name: 'app_actualite_detail')]
    public function details(BlogPost $blogpost)
    : Response
    {
        return $this->render('blogpost/actualite.html.twig', [
            'blogpost' => $blogpost,
        ]);
    }
}
