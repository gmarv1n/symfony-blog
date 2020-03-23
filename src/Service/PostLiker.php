<?php

namespace App\Service;
use App\Entity\BlogPost;
use App\Entity\LikeConnection;
use Doctrine\ORM\EntityManagerInterface;

class PostLiker
{
    private $repository = null;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(LikeConnection::class);
    }

    public function createPostLike(string $userName, string $postSlug) {

        $this->repository->writeLikeConnection($userName, $postSlug);
 
    }

    public function removePostLike(string $userName, string $postSlug) {
        $this->repository->removeLikeConnection($userName, $postSlug);
    }

    public function checkIsLiked() {
        
    }
}