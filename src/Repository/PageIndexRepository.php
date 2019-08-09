<?php

namespace App\Repository;

use App\Entity\PageIndex;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PageIndex|null find($id, $lockMode = null, $lockVersion = null)
 * @method PageIndex|null findOneBy(array $criteria, array $orderBy = null)
 * @method PageIndex[]    findAll()
 * @method PageIndex[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PageIndexRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PageIndex::class);
    }

    // /**
    //  * @return PageIndex[] Returns an array of PageIndex objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PageIndex
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
