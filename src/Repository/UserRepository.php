<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @return User[] Returns an array of User objects
     *
     * @throws NonUniqueResultException
     */
    public function findByRoleAndEmail($email, $role): array
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.email = :email')
            ->setParameter('email', $email)
            ->andWhere('u.roles LIKE :roles')
            ->setParameter('roles', '%'.$role.'%')
            ->orderBy('u.id', 'ASC')
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findByRoleAutor(): QueryBuilder
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.roles LIKE :roles')
            ->setParameter('roles', '%ROLE_ESCRITOR%')
            ->orderBy('u.primerNombre', 'ASC')
        ;
    }

    public function findAllEmailsRoleAlfa(string $query, ?string $role = null, int $limit = 5)
    {
        $qb = $this->createQueryBuilder('u');

        if ($role) {
            $qb->andWhere('u.roles LIKE :roles')
                ->setParameter('roles', '%'.$role.'%');
        }

        $qb->andWhere('u.email LIKE :email')
            ->setParameter('email', '%'.$query.'%');

        //            dd($qb);
        //
        //            $qb->orderBy('u.email', 'ASC')
        //
        //            ;
        return $qb
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
