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
 * @Route("/admin", name="admin_")
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

    /**
     * @Route("/hellsaya", name="hellsaya")
     */
    public function hellsaya()
    {
        return $this->render('dashboard/hellsaya.html.twig', [
            'controller_name' => 'StatController',
        ]);
    }

    /**
     * @Route("/orta", name="orta")
     */
    public function orta()
    {
        return $this->render('dashboard/orta.html.twig', [
            'controller_name' => 'StatController',
        ]);
    }
    /**
     * @Route("/rolls", name="rolls")
     */
    public function rolls()
    {
        return $this->render('dashboard/rolls.html.twig', [
            'controller_name' => 'StatController',
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Dashboard SEO');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
//ici je vais mettre linkToRadmin
        yield MenuItem::section('Dashboard utilisateur');
        yield MenuItem::linktoRoute('Dashboard Hellsaya', 'fas fa-cat', 'admin_hellsaya');
        yield MenuItem::linkToRoute('Dashboard Orta', 'fas fa-crow', 'admin_orta');
        yield MenuItem::linkToRoute('Dashboard Rolls', 'fas fa-ghost', 'admin_rolls');


        yield MenuItem::section('Dashboard CRUD');
        yield MenuItem::linkToCrud('Clients', 'fas fa-building', Customer::class);
        yield MenuItem::linkToCrud('Nom de domaines', 'fas fa-globe', DomainName::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-poo', User::class);
        yield MenuItem::linkToCrud('Ventes', 'fas fa-euro-sign', Sale::class);
        // yield MenuItem::linkToCrud('The Label', 'icon class', EntityClass::class);
    }
}
