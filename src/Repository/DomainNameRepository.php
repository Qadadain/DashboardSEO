<?php

namespace App\Repository;

use App\Entity\DomainName;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DomainName|null find($id, $lockMode = null, $lockVersion = null)
 * @method DomainName|null findOneBy(array $criteria, array $orderBy = null)
 * @method DomainName[]    findAll()
 * @method DomainName[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DomainNameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DomainName::class);
    }

    // /**
    //  * @return DomainName[] Returns an array of DomainName objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DomainName
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
