<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BlogPostLikeRepository")
 */
class BlogPostLike
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $user_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $post_id;

    public function __construct()
    {   
        $uuid = Uuid::uuid4();
        $this->id = $uuid->toString();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getUserId(): ?string
    {
        return $this->user_id;
    }

    public function setUserId(string $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getPostId(): ?string
    {
        return $this->post_slug;
    }

    public function setPostId(string $post_id): self
    {
        $this->post_id = $post_id;

        return $this;
    }
}
