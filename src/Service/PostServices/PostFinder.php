<?php

namespace App\Service\PostServices;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\BlogPost;

class PostFinder
{
    /**
     * @var BlogPostRepository
     */
    private $repository = null;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(BlogPost::class);
    }

    public function getIdBySlug(string $postSlug) : string
    {
        $blogPost = $this->repository->findByPostSlugField($postSlug);
        $blogPostId = $blogPost->getId();
        return $blogPostId;
    }

}