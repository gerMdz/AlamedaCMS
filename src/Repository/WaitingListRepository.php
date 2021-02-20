<?php

namespace App\Repository;

use App\Entity\WaitingList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WaitingList|null find($id, $lockMode = null, $lockVersion = null)
 * @method WaitingList|null findOneBy(array $criteria, array $orderBy = null)
 * @method WaitingList[]    findAll()
 * @method WaitingList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WaitingListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WaitingList::class);
    }

    // /**
    //  * @return WaitingList[] Returns an array of WaitingList objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WaitingList
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
