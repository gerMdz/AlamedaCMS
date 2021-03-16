<?php

namespace App\Repository;

use App\Entity\TypeBlock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeBlock|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeBlock|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeBlock[]    findAll()
 * @method TypeBlock[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeBlockRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeBlock::class);
    }

    // /**
    //  * @return TypeBlock[] Returns an array of TypeBlock objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeBlock
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
