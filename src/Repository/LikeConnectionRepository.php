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

    /**
      * @return LikeConnection Returns a LikeConnection object
      */
    
    public function getLikeConnection($postSlug, $userName)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.post_slug = :postSlug')
            ->andWhere('l.user_name = :userName')
            ->setParameter('postSlug', $postSlug)
            ->setParameter('userName', $userName)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    /**
      * @return true if like connection with argument fields extists
      */
    
      public function isLikeConnectionExtists($postSlug, $userName) : Bool
      {
        $likeConnection = $this->createQueryBuilder('l')
                               ->andWhere('l.post_slug = :postSlug')
                               ->andWhere('l.user_name = :userName')
                               ->setParameter('postSlug', $postSlug)
                               ->setParameter('userName', $userName)
                               ->getQuery()
                               ->getOneOrNullResult();
        if ( $likeConnection != null ) {
            return true;
        } else {
            return false;
        }
          
      }

    public function writeLikeConnection(string $userName, string $postSlug) :Void
    {
        $dbConnection = $this->getEntityManager()->getConnection();

        $sqlRequest = '
            INSERT INTO like_connection (user_name, post_slug)
            VALUES (:userName, :postSlug)
            ';
        $request = $dbConnection->prepare($sqlRequest);
        $request->execute(['userName' => $userName, 'postSlug' => $postSlug]);
    }

    public function removeLikeConnection(string $userName, string $postSlug) :Void
    {
        $dbConnection = $this->getEntityManager()->getConnection();

        $sqlRequest = '
            DELETE FROM like_connection
            WHERE user_name = :userName 
            AND post_slug = :postSlug
            ';
        $request = $dbConnection->prepare($sqlRequest);
        $request->execute(['userName' => $userName, 'postSlug' => $postSlug]);
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
