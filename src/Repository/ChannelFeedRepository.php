<?php

namespace App\Repository;

use App\Entity\ChannelFeed;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ChannelFeed|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChannelFeed|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChannelFeed[]    findAll()
 * @method ChannelFeed[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChannelFeedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChannelFeed::class);
    }

    // /**
    //  * @return ChannelFeed[] Returns an array of ChannelFeed objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    public function findFirst(): ?ChannelFeed
    {
        try {
            return $this->createQueryBuilder('c')
                //            ->andWhere('c.exampleField = :val')
                //            ->setParameter('val', $value)
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException) {
        }
    }
}
