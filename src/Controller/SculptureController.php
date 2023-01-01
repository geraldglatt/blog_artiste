<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\Sculpture;
use App\Form\CommentaireType;
use App\Repository\CommentaireRepository;
use App\Repository\SculptureRepository;
use App\Service\CommentaireService;
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
    public function details(
        Sculpture $sculpture,
        Request $request,
        CommentaireService $commentaireService,
        CommentaireRepository $commentaireRepository,
    ): Response
    {
        $commentaires = $commentaireRepository->findCommentaires($sculpture);
        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $commentaire = $form->getData();
            $commentaireService->persistCommentaire($commentaire, null, null,$sculpture);

            $this->addFlash('success', 'Votre commentaire a bien été envoyé,nous vous en remercions !. 
            Il sera publié après vérification par l\'artiste  ');

            return $this->redirectToRoute('app_sculpture_realisation', ['slug' => $sculpture->getSlug()]);
        }

        return $this->render('sculpture/details.html.twig', [
            'sculpture'     => $sculpture,
            'commentaires'  => $commentaires,
            'formview'      => $form->createView(),
        ]);
    }
}
