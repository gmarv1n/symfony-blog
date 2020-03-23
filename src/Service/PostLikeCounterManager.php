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

    public function incrementLikeCounter(string $postSlug) : Void
    {
        
        $this->repository->incrementPostLikeCounterField($postSlug);
    }

    public function decrementLikeCounter(string $postSlug) : Void
    {        
        $this->repository->decrementPostLikeCounterField($postSlug);
    }
}