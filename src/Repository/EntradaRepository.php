<?php

namespace App\Repository;

use App\Entity\Entrada;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Entrada|null find($id, $lockMode = null, $lockVersion = null)
 * @method Entrada|null findOneBy(array $criteria, array $orderBy = null)
 * @method Entrada[]    findAll()
 * @method Entrada[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntradaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Entrada::class);
    }

    // /**
    //  * @return Entrada[] Returns an array of Entrada objects
    //  */

    public function findByAutor($user)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.autor = :val')
            ->setParameter('val', $user)
            ->orderBy('e.creadaAt', 'DESC')
//            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @param null $user
     * @return Entrada[]
     */
    public function findAllPublicadosOrderedByPublicacion($user = null)
    {
        return $this->addIsPublishedQueryBuilder(null,$user)
            ->orderBy('e.publicadoAt', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }
    /*
    public function findOneBySomeField($value): ?Article
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    private function addIsPublishedQueryBuilder(QueryBuilder $qb = null, $user = null)
    {
        $qb = $this->getOrCreateQueryBuilder($qb)
            ->andWhere('e.publicadoAt IS NOT NULL');
        if($user != null){
            $qb->andWhere('e.autor = :val')
                ->setParameter('val', $user);
        }

        return $qb;


    }
    private function getOrCreateQueryBuilder(QueryBuilder $qb = null)
    {
        return $qb ?: $this->createQueryBuilder('e');
    }
}
