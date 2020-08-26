<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BlogPostRepository")
 * @Vich\Uploadable
 */
class BlogPost
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
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="blog_post_images", fileNameProperty="image_name", size="imageSize")
     *
     * @var File|null
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, unique=true, nullable=false)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image_name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int|null
     */
    private $imageSize;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $short_content;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $category;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $tags;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $author_nick;

    /**
     * @ORM\Column(type="guid")
     */
    private $author_id;

    /**
     * @ORM\Column(type="integer", nullable=true, options={"unsigned":true, "default":0})
     */
    private $likes_count;

    /**
     * @ORM\Column(type="integer", nullable=true, options={"unsigned":true, "default":0})
     */
    private $comments_count;

    public function __construct()
    {
        $this->likes_count = 0;
        $this->comments_count = 0;
    }

    public function getId()
    {
        return $this->id;
    }


    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getImageName(): ?string
    {
        return $this->image_name;
    }

    public function setImageName(?string $image_name): self
    {
        $this->image_name = $image_name;

        return $this;
    }

    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }

    public function getShortContent(): ?string
    {
        return $this->short_content;
    }

    public function setShortContent(string $short_content): self
    {
        $this->short_content = $short_content;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getTags(): ?string
    {
        return $this->tags;
    }

    public function setTags(?string $tags): self
    {
        $this->tags = $tags;

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

    public function getAuthorNick(): ?string
    {
        return $this->author_nick;
    }

    public function setAuthorNick(string $author_nick): self
    {
        $this->author_nick = $author_nick;

        return $this;
    }

    public function getAuthorId()//: ?string
    {
        return $this->author_id;
    }

    public function setAuthorId(string $author_id): self
    {
        $this->author_id = $author_id;
        
        return $this;
    }

    public function getLikesCount(): ?int
    {
        return $this->likes_count;
    }

    public function setLikesCount(int $likes_count): self
    {
        $this->likes_count = $likes_count;

        return $this;
    }

    public function getCommentsCount(): ?int
    {
        return $this->comments_count;
    }

    public function setCommentsCount(int $comments_count): self
    {
        $this->comments_count = $comments_count;

        return $this;
    }
}
