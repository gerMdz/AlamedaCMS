<?php

namespace App\Repository;

use App\Entity\Principal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Principal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Principal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Principal[]    findAll()
 * @method Principal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrincipalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Principal::class);
    }

    /**
     * @param $principal
     * @return Principal[] Returns an array of Principal objects
     */

    public function findByPrincipalParent($principal): array
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.principal = :val')
            ->setParameter('val', $principal)
            ->orderBy('m.updatedAt', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }


    /**
     * @param $principal
     * @return Principal[] Returns an array of Principal objects
     */

    public function findByPrincipalParentActive($principal): array
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.principal = :val')
            ->andWhere('m.isActive = :boolean')
            ->setParameter('val', $principal)
            ->setParameter('boolean', true)
            ->orderBy('m.createdAt', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?Principal
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function getPrincipalSelect()
    {
        return $this->getOrCreateQueryBuilder()
            ->select('p.titulo, p.linkRoute')
            ->orderBy('p.titulo', 'ASC')
            ->getQuery()
            ->getArrayResult();
    }

    private function getOrCreateQueryBuilder(QueryBuilder $qb = null): QueryBuilder
    {
        return $qb ?: $this->createQueryBuilder('p');
    }

    /**
     * @param string|null $qSearch
     * @return QueryBuilder
     */
    public function queryFindAllPrincipals(?string $qSearch): QueryBuilder
    {
        $qb = $this->createQueryBuilder('p')
//            ->andWhere('p.principal is null')
            ->orderBy('p.updatedAt', 'DESC');
            if ($qSearch) {
                $qb->innerJoin('p.autor','a')
                    ->addSelect('a');
                $qb->andWhere('upper(p.contenido) LIKE :qsearch OR upper(a.primerNombre) LIKE :qsearch OR upper(p.titulo) LIKE :qsearch OR upper(p.linkRoute) LIKE :qsearch')
                    ->setParameter('qsearch', '%' . strtoupper($qSearch) . '%')
                ;
            }
            ;

            return $qb;
    }
}
