<?php

namespace App\Repository;

use App\Entity\EnlaceCorto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EnlaceCorto|null find($id, $lockMode = null, $lockVersion = null)
 * @method EnlaceCorto|null findOneBy(array $criteria, array $orderBy = null)
 * @method EnlaceCorto[]    findAll()
 * @method EnlaceCorto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnlaceCortoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EnlaceCorto::class);
    }

    // /**
    //  * @return EnlaceCorto[] Returns an array of EnlaceCorto objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EnlaceCorto
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
