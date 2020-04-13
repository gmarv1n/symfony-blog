<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $user_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $post_slug;

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

    public function __construct()
    {   
        $uuid = Uuid::uuid4();
        $this->id = $uuid->toString();
    }

    public function getId(): ?String
    {
        return $this->id;
    }

    public function getUserName(): ?string
    {
        return $this->user_name;
    }

    public function setUserName(string $user_name): self
    {
        $this->user_name = $user_name;

        return $this;
    }

    public function getPostSlug(): ?string
    {
        return $this->post_slug;
    }

    public function setPostSlug(string $post_slug): self
    {
        $this->post_slug = $post_slug;

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
