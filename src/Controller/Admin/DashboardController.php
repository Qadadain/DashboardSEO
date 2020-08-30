<?php

namespace App\Controller\Admin;

use App\Entity\DomainName;
use App\Entity\Sale;
use App\Entity\Customer;
use App\Entity\User;
use App\Repository\DomainNameRepository;
use App\Repository\UserRepository;
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
     * @var DomainNameRepository
     */
    protected DomainNameRepository $domainNameRepository;

    public function __construct(
        DomainNameRepository $domainNameRepository
    )
    {
      $this->domainNameRepository = $domainNameRepository;
    }

    /**
     * @Route("/")
     */
    public function index(): Response
    {
        return $this->render('bundles/EasyAdminBundle/welcome.html.twig', [
            'countNdd' => $this->domainNameRepository->countAllNdd()
    ]);
    }

    /**
     * @Route("/hellsaya", name="hellsaya")
     * @param UserRepository $userRepository
     * @return Response
     */
    public function hellsaya(UserRepository $userRepository)
    {
        $user = $userRepository->find(2)->getDomainNames()->toArray($userRepository);
        $nbNdd = count($user);

        return $this->render('dashboard/hellsaya.html.twig', [
            'ndds' => $user,
            'count' => $nbNdd,
        ]);
    }

    /**
     * @Route("/orta", name="orta")
     * @param UserRepository $userRepository
     * @return Response
     */
    public function orta(UserRepository $userRepository)
    {
        $user = $userRepository->find(3)->getDomainNames()->toArray($userRepository);
        $nbNdd = count($user);
        return $this->render('dashboard/orta.html.twig', [
            'ndds' => $user,
            'count' => $nbNdd,
        ]);
    }

    /**
     * @Route("/rolls", name="rolls")
     * @param UserRepository $userRepository
     * @return Response
     */
    public function rolls(UserRepository $userRepository)
    {
        $user = $userRepository->find(1)->getDomainNames()->toArray($userRepository);
        $nbNdd = count($user);

        return $this->render('dashboard/rolls.html.twig', [
            'ndds' => $user,
            'count' => $nbNdd,
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
