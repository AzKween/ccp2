<?php

namespace App\Repository;

use App\Entity\GCSGCU;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GCSGCU|null find($id, $lockMode = null, $lockVersion = null)
 * @method GCSGCU|null findOneBy(array $criteria, array $orderBy = null)
 * @method GCSGCU[]    findAll()
 * @method GCSGCU[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GCSGCURepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GCSGCU::class);
    }

    // /**
    //  * @return GCSGCU[] Returns an array of GCSGCU objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GCSGCU
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
