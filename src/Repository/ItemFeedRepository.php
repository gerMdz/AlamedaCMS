<?php

namespace App\Repository;

use App\Entity\ItemFeed;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ItemFeed|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemFeed|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemFeed[]    findAll()
 * @method ItemFeed[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemFeedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemFeed::class);
    }

    // /**
    //  * @return ItemFeed[] Returns an array of ItemFeed objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ItemFeed
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
