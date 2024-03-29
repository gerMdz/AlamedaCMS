<?php

namespace App\Repository;

use App\Entity\Principal;
use DateTime;
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
     * @return Principal[] Returns an array of Principal objects
     */
    public function findByPrincipalParent($principal): array
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.principal = :val')
            ->setParameter('val', $principal)
            ->orderBy('m.updatedAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function getQueryfindByPrincipalParentActive($principal): QueryBuilder
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.principal = :val')
//            ->andWhere('m.isActive = :boolean')
            ->setParameter('val', $principal)
//            ->setParameter('boolean', true)
            ->orderBy('m.createdAt', 'DESC');
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

    private function getOrCreateQueryBuilder(?QueryBuilder $qb = null): QueryBuilder
    {
        return $qb ?: $this->createQueryBuilder('p');
    }

    public function queryFindAllPrincipals(?string $qSearch): QueryBuilder
    {
        $qb = $this->createQueryBuilder('p')
//            ->andWhere('p.principal is null')
            ->orderBy('p.updatedAt', 'DESC');
        if ($qSearch) {
            $qb->innerJoin('p.autor', 'a')
                ->addSelect('a');
            $qb->andWhere(
                'upper(p.contenido) LIKE :qsearch OR upper(a.primerNombre) LIKE :qsearch OR upper(p.titulo) LIKE :qsearch OR upper(p.linkRoute) LIKE :qsearch'
            )
                ->setParameter('qsearch', '%'.strtoupper($qSearch).'%');
        }

        return $qb;
    }

    public function principalByDateAndActiveAndModification(
        DateTime $fecha_inicial,
        DateTime $fecha_final,
        ?array $notPrincipals
    ): QueryBuilder {
        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.isActive = :boolean')
            ->setParameter('boolean', true)
            ->orderBy('p.updatedAt', 'DESC');
        $qb->leftJoin('p.secciones', 's');
        $qb->leftJoin('s.entradas', 'e');
        $qb->andWhere(
            $qb->expr()->between(
                'p.updatedAt',
                ':inicio',
                ':final'
            )
        )
            ->setParameter('inicio', $fecha_inicial)
            ->setParameter('final', $fecha_final);

        $qb->orWhere(
            $qb->expr()->andX(
                $qb->expr()->between(
                    's.updatedAt',
                    ':inicio',
                    ':final'
                ),
                $qb->expr()->eq('s.disponible', true)
            )
        )
            ->setParameter('inicio', $fecha_inicial)
            ->setParameter('final', $fecha_final);

        $qb->orWhere(
            $qb->expr()->andX(
                $qb->expr()->between(
                    'e.updatedAt',
                    ':inicio',
                    ':final'
                ),
                $qb->expr()->isNotNull('e.disponibleAt')
            )
        )
            ->setParameter('inicio', $fecha_inicial)
            ->setParameter('final', $fecha_final);

        //        $qb->andWhere($qb->expr()->notIn('p.id', $notPrincipals));

        return $qb;
    }
}
