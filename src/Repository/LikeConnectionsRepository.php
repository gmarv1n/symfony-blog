<?php

namespace App\Repository;

use App\Entity\LikeConnections;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method LikeConnections|null find($id, $lockMode = null, $lockVersion = null)
 * @method LikeConnections|null findOneBy(array $criteria, array $orderBy = null)
 * @method LikeConnections[]    findAll()
 * @method LikeConnections[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LikeConnectionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LikeConnections::class);
    }

    // /**
    //  * @return LikeConnections[] Returns an array of LikeConnections objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LikeConnections
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
