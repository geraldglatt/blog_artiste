<?php

namespace App\Controller\Admin;

use App\Entity\BlogPost;
use App\Entity\Commentaire;
use App\Entity\Peinture;
use App\Entity\Sculpture;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Stéphane Paillot');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Actualités', 'fas fa-newspaper', BlogPost::class);
        yield MenuItem::linkToCrud('Peintures', 'fas fa-paint-brush', Peinture::class);
        yield MenuItem::linkToCrud('Sculptures', 'fas fa-paint-brush', Sculpture::class);
        yield MenuItem::linkToCrud('Commentaires', 'fas fa-comment', Commentaire::class);
        yield MenuItem::linkToCrud('Paramètres', 'fas fa-cog', User::class);
    }
}
