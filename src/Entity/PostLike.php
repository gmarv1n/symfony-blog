<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostLikeRepository")
 */
class PostLike
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid_binary", unique=true, options={"default"="uuid_binary()"})
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;
    
    /**
     * @ORM\Column(type="uuid_binary")
     */
    private $user_id;

    /**
     * @ORM\Column(type="uuid_binary")
     */
    private $post_id;

    public function getId()//: ?string
    {
        return $this->id;
    }

    public function getUserId()//: ?string
    {
        return $this->user_id;
    }

    public function setUserId(Uuid $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getPostId()//: ?string
    {
        return $this->post_slug;
    }

    public function setPostId(Uuid $post_id): self
    {
        $this->post_id = $post_id;

        return $this;
    }
}
