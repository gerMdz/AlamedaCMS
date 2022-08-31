<?php

namespace App\Repository;

use App\Entity\Entrada;
use DateInterval;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Query\QueryException;
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

    /**
     * @param $user
     * @return mixed
     */
    public function findByAutor($user)
    {
        return $this->queryFindByAutor($user)
            ->getQuery()
            ->getResult();
    }


    /**
     * @param $user
     * @return QueryBuilder
     */
    public function queryFindByAutor($user, ?string $qSearch): QueryBuilder
    {
        $qb = $this->createQueryBuilder('e')
            ->andWhere('e.autor = :val')
            ->setParameter('val', $user)
            ->orderBy('e.updatedAt', 'DESC');

        if ($qSearch) {
            $qb->innerJoin('e.autor', 'a')
                ->addSelect('a');
            $qb->andWhere(
                'upper(e.contenido) LIKE :qsearch OR upper(a.primerNombre) LIKE :qsearch OR upper(e.titulo) LIKE :qsearch'
            )
                ->setParameter('qsearch', '%'.strtoupper($qSearch).'%');
        }

        return $qb;
    }

    /**
     *
     * @return Entrada[]
     * @throws QueryException
     */
    public function findAllPublicadosOrderedByPublicacion($user = null): array
    {
        return $this->findAllPublicadosOrderedByPublicacionQuery($user = null)
            ->getQuery()
            ->getResult();
    }

    /**
     * @throws QueryException
     */
    public function findAllPublicadosOrderedByPublicacionQuery($user = null): QueryBuilder
    {
        $this->createQueryBuilder('e')
            ->addCriteria(self::createNoDeletedCriteria());

        return $this->addIsPublishedQueryBuilder(null, $user)
            ->orderBy('e.publicadoAt', 'DESC');
}

    /**
     *
     * @param $seccion
     * @return Entrada[]
     * @throws QueryException
     */
    public function findAllEntradasBySeccion($seccion): array
    {
        $this->createQueryBuilder('e')
            ->addCriteria(self::createDisponibleForDisponibleAt());

        return $this->getOrCreateQueryBuilder(null)
            ->leftJoin('e.sections', 's')
            ->orderBy('e.orden', 'ASC')
            ->andWhere(
                '(e.disponibleAt <= :today AND e.disponibleHastaAt >= :today)
                OR
                (e.isPermanente = true)'
            )
            ->andWhere('e.publicadoAt is not null')
            ->andWhere('s.id = :section')
            ->setParameter('today', new DateTime('now'))
            ->setParameter('section', $seccion)
            ->getQuery()
            ->getResult();
    }

    public static function createNoDeletedCriteria(): Criteria
    {
        return Criteria::create()
            ->andWhere(Criteria::expr()->eq('isDeleted', false))
            ->orderBy(['createdAt' => 'DESC']);
    }

    public static function createDisponibleForDisponibleAt(): Criteria
    {
        return Criteria::create()
            ->andWhere(Criteria::expr()->eq('disponible', true))
            ->orderBy(['disponibleAt' => 'ASC']);
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
    private function addIsPublishedQueryBuilder(QueryBuilder $qb = null, $user = null): QueryBuilder
    {
        $qb = $this->getOrCreateQueryBuilder($qb)
            ->andWhere('e.publicadoAt IS NOT NULL');
        if (null != $user) {
            $qb->andWhere('e.autor = :val')
                ->setParameter('val', $user);
        }

        return $qb;
    }

    private function addIsDisponibleForSeccion(QueryBuilder $qb = null, $seccion): QueryBuilder
    {
        return $this->getOrCreateQueryBuilder($qb)
            ->andWhere('s.publicadoAt IS NOT NULL');
    }

    private function getOrCreateQueryBuilder(QueryBuilder $qb = null): QueryBuilder
    {
        return $qb ?: $this->createQueryBuilder('e');
    }

    /**
     * @param string|null $qSearch
     * @return QueryBuilder
     */
    public function queryFindAllEntradas(?string $qSearch): QueryBuilder
    {
        $qb = $this->createQueryBuilder('e')
            ->orderBy('e.updatedAt', 'DESC');

        if ($qSearch) {
            $qb->innerJoin('e.autor', 'a')
                ->addSelect('a');
            $qb->andWhere(
                'upper(e.contenido) LIKE :qsearch OR upper(a.primerNombre) LIKE :qsearch OR upper(e.titulo) LIKE :qsearch'
            )
                ->setParameter('qsearch', '%'.strtoupper($qSearch).'%');
        }

        return $qb;
    }

    /**
     */
    public function entradasByDateAndActiveAndModification($fecha_inicial, $fecha_final): QueryBuilder
    {

        $qb = $this->createQueryBuilder('e')
            ->select()
//            ->andWhere('e.disponibleAt is not null')
//            ->orderBy('e.updatedAt', 'DESC')
        ;
        $qb->andWhere(
            $qb->expr()->between(
                'e.updatedAt',
                ':inicio',
                ':final'
            )
        )
            ->setParameter('inicio', $fecha_inicial)
            ->setParameter('final', $fecha_final);

        return $qb;
    }

}
