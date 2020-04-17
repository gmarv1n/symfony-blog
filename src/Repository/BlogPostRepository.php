<?php

namespace App\Repository;

use App\Entity\BlogPost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BlogPost|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlogPost|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlogPost[]    findAll()
 * @method BlogPost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogPostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlogPost::class);
    }

    /**
     * @return BlogPost[] Returns a BlogPost object
     */
    public function findByPostSlugField($slug)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.slug = :slug')
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    /**
     * Increments likes_count field
     */
    public function incrementPostLikeCountField(string $postId)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            UPDATE blog_post
            SET likes_count = likes_count + 1 
            WHERE id = UUID_TO_BIN(:postId)
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['postId' => $postId]);
    }

    /**
     * Decrements likes_count field
     */
    public function decrementPostLikeCountField(string $postId)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            UPDATE blog_post
            SET likes_count = likes_count - 1 
            WHERE id = UUID_TO_BIN(:postId)
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['postId' => $postId]);
    }

    // /**
    //  * @return BlogPost[] Returns an array of BlogPost objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BlogPost
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
