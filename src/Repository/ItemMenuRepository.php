<?php

namespace App\Repository;

use App\Entity\ItemMenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ItemMenu|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemMenu|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemMenu[]    findAll()
 * @method ItemMenu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemMenuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemMenu::class);
    }

    // /**
    //  * @return ItemMenu[] Returns an array of ItemMenu objects
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
    public function findOneBySomeField($value): ?ItemMenu
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
