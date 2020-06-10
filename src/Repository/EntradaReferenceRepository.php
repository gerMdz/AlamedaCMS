<?php

namespace App\Repository;

use App\Entity\EntradaReference;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EntradaReference|null find($id, $lockMode = null, $lockVersion = null)
 * @method EntradaReference|null findOneBy(array $criteria, array $orderBy = null)
 * @method EntradaReference[]    findAll()
 * @method EntradaReference[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntradaReferenceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EntradaReference::class);
    }

    // /**
    //  * @return EntradaReference[] Returns an array of EntradaReference objects
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
    public function findOneBySomeField($value): ?EntradaReference
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
