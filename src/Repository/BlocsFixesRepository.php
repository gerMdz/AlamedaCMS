<?php

namespace App\Repository;

use App\Entity\BlocsFixes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BlocsFixes|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlocsFixes|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlocsFixes[]    findAll()
 * @method BlocsFixes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlocsFixesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlocsFixes::class);
    }

    public function add(BlocsFixes $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function remove(BlocsFixes $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @param string|null $bus Texto para búsqueda
     *
     * @return QueryBuilder with all blocks fixes register
     */
    public function queryAllBlocsFixes(?string $bus): QueryBuilder
    {
        $qb = $this->createQueryBuilder('b')
            ->orderBy('b.updatedAt', 'DESC');

        if ($bus) {
            $qb->andWhere(
                'upper(b.description) LIKE :search OR upper(b.identificador) LIKE :search'
            )
                ->setParameter('search', '%'.strtoupper($bus).'%');
        }

        return $qb;
    }

    /**
     * @throws NonUniqueResultException
     */
    public function getBlockFooterIndex()
    {
        return $this->createQueryBuilder('b')
            ->leftJoin('b.fixes_type', 'ft')
            ->andWhere('ft.identificador = :type')
            ->setParameter('type', 'footer')
            ->andWhere('b.indexAlameda = :index')
            ->setParameter('index', 1)
            ->orderBy('b.updatedAt', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @throws NonUniqueResultException
     */
    public function getBlockFooterPrincipal(string $principal)
    {
        return $this->createQueryBuilder('b')
            ->leftJoin('b.fixes_type', 'ft')
            ->leftJoin('b.page', 'p')
            ->andWhere('ft.identificador = :type')
            ->setParameter('type', 'footer')
            ->andWhere('p.id = :principal')
            ->setParameter('principal', $principal)
            ->orderBy('b.updatedAt', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }


    // /**
    //  * @return BlocsFixes[] Returns an array of BlocsFixes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BlocsFixes
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
