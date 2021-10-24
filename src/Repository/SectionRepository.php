<?php

namespace App\Repository;

use App\Entity\Section;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\Query\QueryException;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Section|null find($id, $lockMode = null, $lockVersion = null)
 * @method Section|null findOneBy(array $criteria, array $orderBy = null)
 * @method Section[]    findAll()
 * @method Section[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SectionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Section::class);
    }

    public static function createActivo():Criteria
    {
        return Criteria::create()
            ->andWhere(Criteria::expr()->eq('disponible', true))
            ->orderBy(['descripcion'=>'ASC'])
            ;
    }

    /**
     *
     * @return QueryBuilder
     * @throws QueryException
     */
    public function findDisponible(): QueryBuilder
    {
        $this->createQueryBuilder('e')
            ->addCriteria(self::createActivo());

        return $this->addIsDisponibleQueryBuilder()
//            ->getQuery()
//            ->getResult()
            ;
    }

    private function addIsDisponibleQueryBuilder(QueryBuilder $qb = null): QueryBuilder
    {
        return $this->getOrCreateQueryBuilder($qb)
            ->andWhere('s.disponible = true');
    }

    private function getOrCreateQueryBuilder(QueryBuilder $qb = null): QueryBuilder
    {
        return $qb ?: $this->createQueryBuilder('s');
    }

    private function getQueryBuilderOrderByUpdate(QueryBuilder $qb = null): QueryBuilder
    {
        $qb = $this->getOrCreateQueryBuilder();
        $qb->orderBy('s.updatedAt','DESC');
        return $qb;
    }


    public function getSections(): QueryBuilder
    {
         return $this->createQueryBuilder('s')
            ->orderBy('s.updatedAt', 'DESC')
            ->addOrderBy('s.name', 'ASC')
        ;
    }


    // /**
    //  * @return Section[] Returns an array of Section objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */


    public function findOneBySomeField($section, $entrada): ?Section
    {
        try {
            return $this->createQueryBuilder('s')
                ->leftJoin('s.entrada', 'e')
                ->andWhere('e.id = :entrada')
                ->andWhere('s.id = :section')
                ->setParameter('entrada', $entrada)
                ->setParameter('section', $entrada)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
        }
    }

    public function queryFindSectionsByPrincipal(string $id): QueryBuilder
    {
        return $this->createQueryBuilder('s')
            ->select()
            ->leftJoin('s.principales', 'p')
            ->andWhere('p.id = :id')
            ->andWhere('s.disponible = true')
            ->setParameter('id', $id)
            ->orderBy('s.orden', 'ASC');
    }
}
