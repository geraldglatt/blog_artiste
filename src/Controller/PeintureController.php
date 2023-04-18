<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\Peinture;
use App\Form\CommentaireType;
use App\Repository\CommentaireRepository;
use App\Repository\PeintureRepository;
use App\Service\CommentaireService;
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
    public function details(
        Peinture $peinture,
        Request $request,
        CommentaireService $commentaireService,
        CommentaireRepository $commentaireRepository,
    ): Response 
    {
        $commentaires = $commentaireRepository->findCommentaires($peinture);
        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $commentaire = $form->getData();
            $commentaireService->persistCommentaire($commentaire, null, $peinture,null);

            $this->addFlash('success', 'Votre commentaire a bien été envoyé,nous vous en remercions. 
            Il sera publié après vérification par l\'artiste.  ');

            return $this->redirectToRoute('app_peintures_realisations', ['slug' => $peinture->getSlug()]);
        }

        return $this->render('peinture/details.html.twig', [
            'peinture'      => $peinture,
            'commentaires'  => $commentaires,
            'formview'      => $form->createView(),
        ]);
    }
}
