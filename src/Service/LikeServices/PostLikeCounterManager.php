<?php
/**
 * PostLikeCounterManager Service
 * 
 * This class manages the likes_sount field in BlogPost table. It uses in LikeConnectionController methods
 * to increment or decrement field. 
 * 
 * @author Gregory Yatsukhno <gyatsukhno@gmail.com>
 * @version 1.0
 */

namespace App\Service\LikeServices;

use App\Entity\BlogPost;
use Doctrine\ORM\EntityManagerInterface;

class PostLikeCounterManager
{   
    /**
     * @var BlogPostRepository is a dependency to use BlogPostRepository methods
     */
    private $repository = null;

    /**
     * Constructor for $repository
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(BlogPost::class);
    }

    /**
     * incrementLikeCount
     * 
     * This function recieve $postSlug as a parameter and 
     * uses BlogPostRepository method incrementPostLikeCountField()
     * 
     * @param string $postSlug - slug of post wich likes_count field needed to increment
     * 
     * @return void
     */
    public function incrementLikeCount(string $postSlug) : Void
    {
        $this->repository->incrementPostLikeCountField($postSlug);
    }

    /**
     * decrementLikeCount
     * 
     * This function recieve $postSlug as a parameter and 
     * uses BlogPostRepository method decrementPostLikeCountField()
     * 
     * @param string $postSlug - slug of post wich likes_count field needed to decrement
     * 
     * @return void
     */
    public function decrementLikeCount(string $postSlug) : Void
    {        
        $this->repository->decrementPostLikeCountField($postSlug);
    }
}