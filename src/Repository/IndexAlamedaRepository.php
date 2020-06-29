<?php

namespace App\Repository;

use App\Entity\IndexAlameda;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method IndexAlameda|null find($id, $lockMode = null, $lockVersion = null)
 * @method IndexAlameda|null findOneBy(array $criteria, array $orderBy = null)
 * @method IndexAlameda[]    findAll()
 * @method IndexAlameda[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IndexAlamedaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IndexAlameda::class);
    }

    public function findLemaField()
    {
        $value = 'index';

        return $this->createQueryBuilder('i')
            ->andWhere('i.base = :val')
            ->setParameter('val', $value)
            ->orderBy('i.base', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?IndexAlameda
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
