<?php

namespace App\Repository;

use App\Entity\GroupCelebration;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GroupCelebration|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupCelebration|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupCelebration[]    findAll()
 * @method GroupCelebration[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupCelebrationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GroupCelebration::class);
    }

     /**
      * @return QueryBuilder Returns an array of GroupCelebration objects
      */

    public function findByActive(): QueryBuilder
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.isActivo = :val')
            ->setParameter('val', true)
            ->orderBy('g.title', 'ASC');
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?GroupCelebration
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    /**
     * @return QueryBuilder Returns an array of Celebracion objects
     */

    public function puedeMostrarse(): QueryBuilder
    {
        return $this->createQueryBuilder('g')
            ->leftJoin('g.celebraciones', 'c')
            ->andWhere('c.isHabilitada = :hab')
            ->andWhere('g.isActivo = :hab')
            ->andWhere('c.disponibleAt <= :today')
            ->andWhere('c.disponibleHastaAt >= :today')
            ->orderBy('c.fechaCelebracionAt', 'ASC')
            ->setParameter('hab', true)
            ->setParameter('today',new DateTime('now'))
            ;
    }
}
