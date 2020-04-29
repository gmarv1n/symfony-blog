<?php
/**
 * CommentsCountManager Service
 * 
 * 
 * @author Gregory Yatsukhno <gyatsukhno@gmail.com>
 * @version 28.04.2020
 */

namespace App\Service\PostServices;

use App\Entity\BlogPost;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use Ramsey\Uuid\Uuid;

class CommentsCountManager
{
    /**
     * @var BlogPostRepository 
     */
    private $BlogPostRepository;

    /**
     * Constructor for initializing private variables.
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->blogPostRepository = $entityManager->getRepository(BlogPost::class);
    }

    /**
     * Increment
     * 
     * @return void
     */
    public function increment(string $postId) : Void
    {
        $this->blogPostRepository->incrementCommentsCount($postId);
    }

    /**
     * Decrement
     * 
     * @return void
     */
    public function decrement(string $postId) : Void
    {
        $this->blogPostRepository->decrementCommentsCount($postId);
    }
}