<?php

namespace App\Repository;

use App\Entity\MetaBase;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MetaBase|null find($id, $lockMode = null, $lockVersion = null)
 * @method MetaBase|null findOneBy(array $criteria, array $orderBy = null)
 * @method MetaBase[]    findAll()
 * @method MetaBase[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MetaBaseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MetaBase::class);
    }

    // /**
    //  * @return MetaBase[] Returns an array of MetaBase objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MetaBase
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
