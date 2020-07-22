<?php

namespace App\Repository;

use App\Entity\Comentario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Comentario|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comentario|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comentario[]    findAll()
 * @method Comentario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComentarioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comentario::class);
    }


    /**
     * @param string|null $qSearch
     */
    public function searchQueryBuilder(?string $qSearch):QueryBuilder
    {
        $qb = $this->createQueryBuilder('c');
        $qb->innerJoin('c.entrada','e')
            ->addSelect('e');
        $qb->innerJoin('c.autor','a')
            ->addSelect('a');
        if ($qSearch) {
            $qb->andWhere('c.contenido LIKE :qsearch OR a.primerNombre LIKE :qsearch OR e.titulo LIKE :qsearch')
                ->setParameter('qsearch', '%' . $qSearch . '%')
            ;
        }
        return $qb
            ->orderBy('c.createdAt', 'DESC')
            ;
    }


    /**
     * @param string|null $qSearch
     * @return Comentario[] Returns an array of Comentario objects
     */
    public function findAllSearch(?string  $qSearch)
    {
        $qb = $this->searchQueryBuilder($qSearch);
        return $qb
            ->getQuery()
            ->getResult()
            ;

    }

    // /**
    //  * @return Comentario[] Returns an array of Comentario objects
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

    /*
    public function findOneBySomeField($value): ?Comentario
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
