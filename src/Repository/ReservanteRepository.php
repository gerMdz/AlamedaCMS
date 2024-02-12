<?php

namespace App\Repository;

use App\Entity\Reservante;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Reservante|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservante|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservante[]    findAll()
 * @method Reservante[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservanteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservante::class);
    }

    // /**
    //  * @return Reservante[] Returns an array of Reservante objects
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

    public function findOneByReserva($celebracion, $email): ?Reservante
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.celebracion = :cel')
            ->andWhere('r.email = :email')
            ->setParameter('cel', $celebracion)
            ->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
