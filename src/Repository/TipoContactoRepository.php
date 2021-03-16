<?php

namespace App\Repository;

use App\Entity\TipoContacto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TipoContacto|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoContacto|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoContacto[]    findAll()
 * @method TipoContacto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoContactoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoContacto::class);
    }

    // /**
    //  * @return TipoContacto[] Returns an array of TipoContacto objects
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
    public function findOneBySomeField($value): ?TipoContacto
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
