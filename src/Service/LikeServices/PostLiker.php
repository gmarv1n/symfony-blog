<?php

namespace App\Service\LikeServices;
use App\Entity\LikeConnection;
use Doctrine\ORM\EntityManagerInterface;

class PostLiker
{
    private $repository = null;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(LikeConnection::class);
    }

    public function createPostLike(string $userName, string $postSlug) : Void
    {
        $this->repository->writeLikeConnection($userName, $postSlug);
    }

    public function removePostLike(string $userName, string $postSlug) : Void
    {
        $this->repository->removeLikeConnection($userName, $postSlug);
    }

    public function isLiked(string $userName, string $postSlug) : Bool
    {
        return $this->repository->isLikeConnectionExtists($userName, $postSlug);;
    }
}