<?php

namespace App\Repository;

use App\Entity\LikeConnection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method LikeConnection|null find($id, $lockMode = null, $lockVersion = null)
 * @method LikeConnection|null findOneBy(array $criteria, array $orderBy = null)
 * @method LikeConnection[]    findAll()
 * @method LikeConnection[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LikeConnectionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LikeConnection::class);
    }

    // /**
    //  * @return LikeConnection[] Returns an array of LikeConnection objects
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
    public function findOneBySomeField($value): ?LikeConnection
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
