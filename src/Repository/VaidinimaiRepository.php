<?php

namespace App\Repository;

use App\Entity\Vaidinimai;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Vaidinimai|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vaidinimai|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vaidinimai[]    findAll()
 * @method Vaidinimai[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VaidinimaiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vaidinimai::class);
    }

    // /**
    //  * @return Vaidinimai[] Returns an array of Vaidinimai objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Vaidinimai
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
