<?php

namespace App\Controller\Admin;

use App\Entity\DomainName;
use App\Entity\Sale;
use App\Entity\Customer;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin", name="admin")
 */
class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/")
     */
    public function index(): Response
    {
        return $this->render('bundles/EasyAdminBundle/welcome.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Dashboard SEO');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
//ici je vais mettre linkToRoute
        yield MenuItem::section('Dashboard utilisateur');
        yield MenuItem::linkToCrud('Dashboard Hellsaya', 'fas fa-cat', Sale::class );
        yield MenuItem::linkToCrud('Dashboard Orta', 'fas fa-crow', Sale::class);
        yield MenuItem::linkToCrud('Dashboard Rolls', 'fas fa-ghost', Sale::class);


        yield MenuItem::section('Dashboard CRUD');
        yield MenuItem::linkToCrud('Clients', 'fas fa-building', Customer::class);
        yield MenuItem::linkToCrud('Nom de domaines', 'fas fa-globe', DomainName::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-poo', User::class);
        yield MenuItem::linkToCrud('Ventes', 'fas fa-euro-sign', Sale::class);
        // yield MenuItem::linkToCrud('The Label', 'icon class', EntityClass::class);
    }
}
