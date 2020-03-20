<?php

namespace App\Service;
use App\Entity\BlogPost;
use Doctrine\ORM\EntityManagerInterface;

class PostLikeCounterManager
{
    private $repository = null;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(BlogPost::class);
    }

    public function incrementLikeCounter($post) : Void
    {
        $postSlug = $post->getSlug();
        
        $this->repository->incrementPostLikeCounterField($postSlug);
    }
}