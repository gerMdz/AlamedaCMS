<?php

namespace App\Repository;

use App\Entity\ModelTemplate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ModelTemplate|null find($id, $lockMode = null, $lockVersion = null)
 * @method ModelTemplate|null findOneBy(array $criteria, array $orderBy = null)
 * @method ModelTemplate[]    findAll()
 * @method ModelTemplate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModelTemplateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ModelTemplate::class);
    }

    // /**
    //  * @return ModelTemplate[] Returns an array of ModelTemplate objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ModelTemplate
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
