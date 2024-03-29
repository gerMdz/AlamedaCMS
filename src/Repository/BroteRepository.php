<?php

namespace App\Repository;

use App\Entity\Brote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Brote|null find($id, $lockMode = null, $lockVersion = null)
 * @method Brote|null findOneBy(array $criteria, array $orderBy = null)
 * @method Brote[]    findAll()
 * @method Brote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BroteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Brote::class);
    }

    // /**
    //  * @return Brote[] Returns an array of Brote objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Brote
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getBrotesSelect()
    {
        return $this->getOrCreateQueryBuilder()
            ->select('b.titulo, b.linkRoute')
        ->orderBy('b.titulo', 'ASC')
        ->getQuery()
        ->getResult(Query::HYDRATE_ARRAY);
    }

    private function getOrCreateQueryBuilder(QueryBuilder $qb = null)
    {
        return $qb ?: $this->createQueryBuilder('b');
    }
}
