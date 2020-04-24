<?php
/**
 * PostFinder Service
 * 
 * This class find the post id by post_slug, in LikeConnectionController
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
     * getIdBySlug
     * 
     * This method recieve string postSlug, get the BlogPost object by using
     * blogPostRepository's findByPostSlugField(), get its ID and returns it
     * 
     * @param string $postSlug
     * 
     * @return string $blogPostId
     */
    public function getIdBySlug(string $postSlug) : string
    {
        $blogPost = $this->repository->findByPostSlugField($postSlug);
        $blogPostId = $blogPost->getId();
        return $blogPostId;
    }

}