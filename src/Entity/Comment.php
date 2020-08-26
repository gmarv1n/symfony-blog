<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment
{
    // /**
    //  * @ORM\Id
    //  * @ORM\Column(type="uuid_binary", unique=true)
    //  * @ORM\GeneratedValue(strategy="CUSTOM")
    //  * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
    //  */
    // private $id;

    /**
     * @ORM\Id
     * @ORM\Column(type="guid", unique=true)
     * @ORM\GeneratedValue(strategy="UUID")
     */
     private $id;

    /**
     * @ORM\Column(type="guid", nullable=false)
     */
    private $author_id;

    /**
     * @ORM\Column(type="guid", nullable=false)
     */
    private $post_id;

    /**
     * @ORM\Column(type="text")
     */
    private $comment;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_approved;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    public function getId(): ?String
    {
        return $this->id;
    }

    public function getAuthorId(): ?string
    {
        return $this->author_id;
    }

    public function setAuthorId(string $author_id): self
    {
        $this->author_id = $author_id;

        return $this;
    }

    public function getPostId(): ?string
    {
        return $this->post_id;
    }

    public function setPostId(string $post_id): self
    {
        $this->post_id = $post_id;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getIsApproved(): ?bool
    {
        return $this->is_approved;
    }

    public function setIsApproved(bool $is_approved): self
    {
        $this->is_approved = $is_approved;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
