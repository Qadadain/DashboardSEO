<?php

namespace App\Controller\Admin;

use App\Entity\DomainName;
use App\Entity\Sale;
use App\Entity\Customer;
use App\Entity\User;
use App\Repository\DomainNameRepository;
use App\Repository\SaleRepository;
use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\DashboardDto;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin", name="admin_")
 */
class DashboardController extends AbstractDashboardController
{

    /**
     * @Route("/", name="home")
     * @param SaleRepository $saleRepository
     * @param DomainNameRepository $domainNameRepository
     * @return Response
     */
    public function mainDash(SaleRepository $saleRepository, DomainNameRepository $domainNameRepository): Response
    {
        $allDomain = $domainNameRepository->findAll();
        $sumByNdd = $saleRepository->sumByDomain();
        $sumByCustomer = $saleRepository->sumByIntermediate();
        dd($sumByCustomer);
        return $this->render('bundles/EasyAdminBundle/welcome.html.twig', [
            'allSales' => $saleRepository->sumSales()[1],
            'countNdd' => count($allDomain),
            'sumByNdds' => $sumByNdd
        ]);
    }

    /**
     * @Route("/hellsaya", name="hellsaya")
     * @param UserRepository $userRepository
     * @param SaleRepository $saleRepository
     * @return Response
     */
    public function hellsaya(UserRepository $userRepository, SaleRepository $saleRepository)
    {
        $ndd = $userRepository->find(2)->getDomainNames()->toArray($userRepository);
        $nbNdd = count($ndd);
        $sumSales = $saleRepository->userSumSales($userRepository->find(2));
        $sumSales = implode($sumSales);

        return $this->render('dashboard/hellsaya.html.twig', [
            'ndds' => $ndd,
            'count' => $nbNdd,
            'sum' => $sumSales,
        ]);
    }

    /**
     * @Route("/orta", name="orta")
     * @param UserRepository $userRepository
     * @param SaleRepository $saleRepository
     * @return Response
     */
    public function orta(UserRepository $userRepository, SaleRepository $saleRepository)
    {
        $ndd = $userRepository->find(3)->getDomainNames()->toArray($userRepository);
        $nbNdd = count($ndd);
        $sumSales = $saleRepository->userSumSales($userRepository->find(3));
        $sumSales = implode($sumSales);

        return $this->render('dashboard/orta.html.twig', [
            'ndds'  => $ndd,
            'count' => $nbNdd,
            'sum'   => $sumSales
        ]);
    }

    /**
     * @Route("/rolls", name="rolls")
     * @param UserRepository $userRepository
     * @param SaleRepository $saleRepository
     * @return Response
     */
    public function rolls(UserRepository $userRepository, SaleRepository $saleRepository)
    {
        $ndd = $userRepository->find(1)->getDomainNames()->toArray($userRepository);
        $nbNdd = count($ndd);
        $sumSales = $saleRepository->userSumSales($userRepository->find(1));
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
//ici je vais mettre linkToRadmin
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
