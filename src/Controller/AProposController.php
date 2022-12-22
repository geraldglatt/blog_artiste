<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AProposController extends AbstractController
{
    #[Route('/a-propos', name: 'app_a_propos')]
    public function index(UserRepository $userRepository): Response
    {
        $peintre = $userRepository->getPeintre();

        return $this->render('a_propos/index.html.twig', [
            'peintre' => $peintre,
        ]);
    }
}
