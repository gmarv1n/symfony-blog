<?php

namespace App\Repository;

use App\Entity\BlogPostLike;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method LikeConnection|null find($id, $lockMode = null, $lockVersion = null)
 * @method LikeConnection|null findOneBy(array $criteria, array $orderBy = null)
 * @method LikeConnection[]    findAll()
 * @method LikeConnection[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogPostLikeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LikeConnection::class);
    }

    /**
      * @return LikeConnection Returns a LikeConnection object
      */
    
    public function getLikeConnection($postId, $userId)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.post_id = :postId')
            ->andWhere('l.user_id = :userId')
            ->setParameter('postId', $postId)
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    /**
      * @return true if like connection with argument fields extists
      */
    
      public function isLikeConnectionExtists($userId, $postId) : Bool
      {
        $likeConnection = $this->createQueryBuilder('l')
                               ->andWhere('l.post_id = :postId')
                               ->andWhere('l.user_id = :userId')
                               ->setParameter('postId', $postId)
                               ->setParameter('userId', $userId)
                               ->getQuery()
                               ->getOneOrNullResult();
        if ( $likeConnection != null ) {
            return true;
        } else {
            return false;
        }
          
      }

    public function writeLikeConnection(string $userId, string $postId) :Void
    {
        $dbConnection = $this->getEntityManager()->getConnection();

        $sqlRequest = '
            INSERT INTO blog_post_like (user_id, post_id)
            VALUES (:userId, :postId)
            ';
        $request = $dbConnection->prepare($sqlRequest);
        $request->execute(['userId' => $userId, 'postId' => $postId]);
    }

    public function removeLikeConnection(string $userId, string $postId) :Void
    {
        $dbConnection = $this->getEntityManager()->getConnection();

        $sqlRequest = '
            DELETE FROM blog_post_like
            WHERE user_name = :userId 
            AND post_slug = :postId
            ';
        $request = $dbConnection->prepare($sqlRequest);
        $request->execute(['userId' => $userId, 'postId' => $postId]);
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
