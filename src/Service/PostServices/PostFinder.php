<?php
/**
 * PostFinder Service
 *
 * This class find the post by post_id, and return it
 *
 * @author Gregory Yatsukhno <gyatsukhno@gmail.com>
 * @version 1.0
 */

namespace App\Service\PostServices;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\BlogPost;

class PostFinder
{
    /**
     * @var BlogPostRepository - dependency for using BlogPostRepository methods
     */
    private $repository = null;

    /**
     * Constructor for private variables
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(BlogPost::class);
    }

    /**
     * getPostById
     *
     * @param string $postId
     *
     * @return BlogPost $blogPost
     */
    public function getPostById(string $postId) : BlogPost
    {
        $blogPost = $this->repository->getPostById($postId);
        return $blogPost;
    }
}
