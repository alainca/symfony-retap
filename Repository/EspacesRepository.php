<?php

namespace App\Repository;

use App\Entity\Espaces;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Espaces|null find($id, $lockMode = null, $lockVersion = null)
 * @method Espaces|null findOneBy(array $criteria, array $orderBy = null)
 * @method Espaces[]    findAll()
 * @method Espaces[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EspacesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Espaces::class);
    }

    // /**
    //  * @return Espaces[] Returns an array of Home objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Espaces
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
