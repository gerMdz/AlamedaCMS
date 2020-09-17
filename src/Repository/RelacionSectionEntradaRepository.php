<?php

namespace App\Repository;

use App\Entity\RelacionSectionEntrada;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RelacionSectionEntrada|null find($id, $lockMode = null, $lockVersion = null)
 * @method RelacionSectionEntrada|null findOneBy(array $criteria, array $orderBy = null)
 * @method RelacionSectionEntrada[]    findAll()
 * @method RelacionSectionEntrada[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RelacionSectionEntradaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RelacionSectionEntrada::class);
    }

    // /**
    //  * @return RelacionSectionEntrada[] Returns an array of RelacionSectionEntrada objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RelacionSectionEntrada
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
