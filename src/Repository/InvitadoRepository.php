<?php

namespace App\Repository;

use App\Entity\Invitado;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Types\IntegerType;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Invitado|null find($id, $lockMode = null, $lockVersion = null)
 * @method Invitado|null findOneBy(array $criteria, array $orderBy = null)
 * @method Invitado[]    findAll()
 * @method Invitado[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InvitadoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Invitado::class);
    }

    // /**
    //  * @return Invitado[] Returns an array of Invitado objects
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


    /**
     * @param string $value
     * @return int|mixed|string
     */
    public function countByCelebracion(string $value)
    {

            return $this->createQueryBuilder('i')
                ->select('count(i.id) as ocupado')
                ->andWhere('i.celebracion = :val')
                ->setParameter('val', $value)
                ->getQuery()
                ->getSingleScalarResult();

    }

    public function findOneByReserva($invitado, $email): ?Invitado
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.id = :invitado')
            ->andWhere('i.email = :email')
            ->setParameter('invitado', $invitado)
            ->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

}
