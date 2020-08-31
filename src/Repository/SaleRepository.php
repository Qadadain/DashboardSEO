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
/*    public function sumSales(User $user)
    {
        return $this->createQueryBuilder('s')
            ->select('SUM(s.price)')
            ->where('s.user = :user')
            ->setParameter('user', $user)
            ->getQuery()->getOneOrNullResult();
    }*/
}

