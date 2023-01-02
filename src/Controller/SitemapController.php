<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Repository\BlogPostRepository;
use App\Repository\CategoryRepository;
use App\Repository\PeintureRepository;
use App\Repository\SculptureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SitemapController extends AbstractController
{
    #[Route('/sitemap.xml', name: 'app_sitemap', defaults:(['_format' => 'xml']) )]
    public function index(
        Request $request,
        PeintureRepository $peintureRepository,
        SculptureRepository $sculptureRepository,
        BlogPostRepository $blogPostRepository,
        CategoryRepository $categoryRepository
    ): Response {
        $hostname = $request->getSchemeAndHttpHost();

        $urls = [];

        $urls[] = ['loc' => $this->generateUrl('app_home')];
        $urls[] = ['loc' => $this->generateUrl('app_peintures')];
        $urls[] = ['loc' => $this->generateUrl('app_sculpture')];
        $urls[] = ['loc' => $this->generateUrl('app_actualites')];
        $urls[] = ['loc' => $this->generateUrl('app_portfolio')];
        $urls[] = ['loc' => $this->generateUrl('app_a_propos')];
        $urls[] = ['loc' => $this->generateUrl('app_contact')];

        foreach($peintureRepository->findAll() as $peinture) {
            $urls[] = [
                'loc' => $this->generateUrl('app_peintures_realisations', ['slug' => $peinture->getSlug()]),
                'lastmod'=> $peinture->getCreatedAt()->format('Y-m-d')
            ];
        }

        foreach($sculptureRepository->findAll() as $sculpture) {
            $urls[] = [
                'loc' => $this->generateUrl('app_sculpture_realisation', ['slug' => $sculpture->getSlug()]),
                'lastmod'=> $sculpture->getCreatedAt()->format('Y-m-d')
            ];
        }

        foreach($blogPostRepository->findAll() as $blogPost) {
            $urls[] = [
                'loc' => $this->generateUrl('app_actualite_detail', ['slug' => $blogPost->getSlug()]),
                'lastmod'=> $blogPost->getCreatedAt()->format('Y-m-d')
            ];
        }

        foreach($categoryRepository->findAll() as $category) {
            $urls[] = [
                'loc' => $this->generateUrl('app_portfolio_category', ['slug' => $category->getSlug()])
            ];
        }


        $response = new Response(
            $this->renderView('sitemap/index.html.twig', [
                'urls'     =>$urls,
                'hostname' =>$hostname,
            ]),
            200
        );

        $response->headers->set('Content-type', 'text/xml');

        return $response;
    }
}
