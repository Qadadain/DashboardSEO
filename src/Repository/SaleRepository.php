<?php

namespace App\Repository;

use App\Entity\Sale;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sale|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sale|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sale[]    findAll()
 * @method Sale[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SaleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sale::class);
    }

    public function sumSales()
    {
        return $this->createQueryBuilder('s')
            ->select('SUM(s.price)')
            ->getQuery()->getOneOrNullResult();
    }
   public function userSumSales(User $user)
    {
        return $this->createQueryBuilder('s')
            ->select('SUM(s.price)')
            ->where('s.user = :user')
            ->setParameter('user', $user)
            ->getQuery()->getOneOrNullResult();
    }

    // MAIN DASHBOARD

    public function sumByDomain(){
        return $this->createQueryBuilder('s')
            ->select('SUM(s.price) as price')
            ->innerJoin('s.domainName', 'd')
            ->addSelect('d.name')
            ->addSelect('d.color')
            ->groupBy('d.name', 'd.color')
            ->getQuery()->getResult();
    }

    public function sumByIntermediate(){
        return $this->createQueryBuilder('s')
            ->select('SUM(s.price) as price')
            ->innerJoin('s.customer', 'c')
            ->addSelect('c.name')
            ->addSelect('c.color')
            ->groupBy('c.name', 'c.color')
            ->getQuery()->getArrayResult();
    }

    public function sumByUser(){
        return $this->createQueryBuilder('s')
            ->select('SUM(s.price) as price')
            ->innerJoin('s.user', 'u')
            ->addSelect('u.pseudo')
            ->addSelect('u.color')
            ->groupBy('u.pseudo', 'u.color')
            ->getQuery()->getArrayResult();
    }
    // HELLSAYA DASHBOARD

    // ORTA DASHBOARD

    // ROLLS DASHBOARD

}

