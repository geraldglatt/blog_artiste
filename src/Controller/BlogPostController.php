<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Repository\BlogPostRepository;
use App\Repository\CommentaireRepository;
use App\Service\CommentaireService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogPostController extends AbstractController
{
    #[Route('/actualites', name: 'app_actualites')]
    public function actualites(
        BlogPostRepository $blogPostRepository,
        PaginatorInterface $paginatorInterface,
        Request $request
    ): Response
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
    public function details(
        BlogPost $blogpost,
        Request $request,
        CommentaireService $commentaireService,
        CommentaireRepository $commentaireRepository,
        ): Response
    {
        $commentaires = $commentaireRepository->findCommentaires($blogpost);
        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $commentaire = $form->getData();
            $commentaireService->persistCommentaire($commentaire, $blogpost, null, null);

            $this->addFlash('success', 'Votre commentaire a bien été envoyé,nous vous en remercions !. 
            Il sera publié après vérification par l\'artiste  ');

            return $this->redirectToRoute('app_actualite_detail', ['slug' => $blogpost->getSlug()]);
        }

        return $this->render('blogpost/actualite.html.twig', [
            'blogpost'      => $blogpost,
            'commentaires'  => $commentaires,
            'formview'      => $form->createView(),
        ]);
    }
    
}
