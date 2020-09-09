<?php

namespace App\Controller\Admin;

use App\Entity\DomainName;
use App\Entity\Sale;
use App\Entity\Customer;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
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
     * @Route("/", name="home")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function mainDash(EntityManagerInterface $em): Response
    {
        // Repository
        $sale = $em->getRepository('App:Sale');
        $dName = $em->getRepository('App:DomainName');

        $allDomain = $dName->findAll();
        $sumByNdd = $sale->sumByDomain();

        return $this->render('bundles/EasyAdminBundle/welcome.html.twig', [
            'allSales' => $sale->sumSales()[1],
            'countNdd' => count($allDomain),
            'sumByNdds' => $sumByNdd
        ]);
    }

    /**
     * @Route("/hellsaya", name="hellsaya")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function hellsaya(EntityManagerInterface $em): Response
    {
        // Repository
        $sale = $em->getRepository('App:Sale');
        $user = $em->getRepository('App:User');

        $ndd = $user->find(2)->getDomainNames()->toArray($user);
        $nbNdd = count($ndd);
        $sumSales = $sale->userSumSales($user->find(2));
        $sumSales = implode($sumSales);

        return $this->render('dashboard/hellsaya.html.twig', [
            'ndds' => $ndd,
            'count' => $nbNdd,
            'sum' => $sumSales,
        ]);
    }

    /**
     * @Route("/orta", name="orta")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function orta(EntityManagerInterface $em): Response
    {
        // Repository
        $user = $em->getRepository('App:User');
        $sale = $em->getRepository('App:Sale');

        $ndd = $user->find(3)->getDomainNames()->toArray($user);
        $nbNdd = count($ndd);
        $sumSales = $sale->userSumSales($user->find(3));
        $sumSales = implode($sumSales);

        return $this->render('dashboard/orta.html.twig', [
            'ndds'  => $ndd,
            'count' => $nbNdd,
            'sum'   => $sumSales
        ]);
    }

    /**
     * @Route("/rolls", name="rolls")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function rolls(EntityManagerInterface $em): Response
    {
        // Repository
        $user = $em->getRepository('App:User');
        $sale = $em->getRepository('App:Sale');

        $ndd = $user->find(1)->getDomainNames()->toArray($user);
        $nbNdd = count($ndd);
        $sumSales = $sale->userSumSales($user->find(1));
        $sumSales = implode($sumSales);

        return $this->render('dashboard/rolls.html.twig', [
            'ndds'  => $ndd,
            'count' => $nbNdd,
            'sum'   => $sumSales,
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Dashboard SEO');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoRoute('Dashboard', 'fa fa-home', 'admin_home');
        yield MenuItem::section('Dashboard utilisateur');
        yield MenuItem::linktoRoute('Dashboard Hellsaya', 'fas fa-cat', 'admin_hellsaya');
        yield MenuItem::linkToRoute('Dashboard Orta', 'fas fa-crow', 'admin_orta');
        yield MenuItem::linkToRoute('Dashboard Rolls', 'fas fa-ghost', 'admin_rolls');


        yield MenuItem::section('Dashboard CRUD');
        yield MenuItem::linkToCrud('Intermédiaires', 'fas fa-building', Customer::class);
        yield MenuItem::linkToCrud('Nom de domaines', 'fas fa-globe', DomainName::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-poo', User::class);
        yield MenuItem::linkToCrud('Ventes', 'fas fa-euro-sign', Sale::class);
        // yield MenuItem::linkToCrud('The Label', 'icon class', EntityClass::class);
    }
}
