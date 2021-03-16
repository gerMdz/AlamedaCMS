<?php

namespace App\Repository;

use App\Entity\Ministerio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ministerio|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ministerio|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ministerio[]    findAll()
 * @method Ministerio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MinisterioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ministerio::class);
    }

    // /**
    //  * @return Ministerio[] Returns an array of Ministerio objects
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
    public function findOneBySomeField($value): ?Ministerio
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
