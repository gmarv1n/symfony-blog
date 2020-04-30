<?php

namespace App\Repository;

use App\Entity\PostLike;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Gregory\UuidToBinBundle\Doctrine\ORM\Query\UUID\Functions\UuidToBinFunction;
use App\Entity\BlogPost;
use App\Entity\User;

/**
 * @method LikeConnection|null find($id, $lockMode = null, $lockVersion = null)
 * @method LikeConnection|null findOneBy(array $criteria, array $orderBy = null)
 * @method LikeConnection[]    findAll()
 * @method LikeConnection[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostLikeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PostLike::class);
    }

    /**
      * @return PostLike[] 
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
    
      public function isLikeExtist(User $user, BlogPost $post) : Bool
      {
        $userId = $user->getId();

        $postId = $post->getId();

        $likeConnection = $this->createQueryBuilder('l')
                               ->andWhere('l.post_id = UUID_TO_BIN(:postId)')
                               ->andWhere('l.user_id = UUID_TO_BIN(:userId)')
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

    public function writeLike(User $user, BlogPost $post) :Void
    {
        $userId = $user->getId();

        $postId = $post->getId();

        $dbConnection = $this->getEntityManager()->getConnection();

        $sqlRequest = '
            INSERT INTO post_like (user_id, post_id)
            VALUES (UUID_TO_BIN(:userId), UUID_TO_BIN(:postId) )
            ';
        $request = $dbConnection->prepare($sqlRequest);
        $request->execute(['userId' => $userId, 'postId' => $postId]);
    }

    public function removeLike(User $user, BlogPost $post) :Void
    {
        $userId = $user->getId();

        $postId = $post->getId();

        $dbConnection = $this->getEntityManager()->getConnection();

        $sqlRequest = '
            DELETE FROM post_like
            WHERE user_id = UUID_TO_BIN(:userId)
            AND post_id = UUID_TO_BIN(:postId)
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
