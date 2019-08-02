<?php

namespace App\Repository;

use App\Entity\IndexAlameda;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method IndexAlameda|null find($id, $lockMode = null, $lockVersion = null)
 * @method IndexAlameda|null findOneBy(array $criteria, array $orderBy = null)
 * @method IndexAlameda[]    findAll()
 * @method IndexAlameda[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IndexAlamedaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, IndexAlameda::class);
    }

    // /**
    //  * @return IndexAlameda[] Returns an array of IndexAlameda objects
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
