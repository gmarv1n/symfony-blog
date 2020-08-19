<?php
/**
 * BlogPostLiker Service
 *
 * This class manage the creating a LikeConnection in database for the selected post.
 * It uses in LikeUrlGenerator and LikeConnection controller.
 *
 * @author Gregory Yatsukhno <gyatsukhno@gmail.com>
 * @version 1.01
 */

namespace App\Service\LikeServices;

use App\Entity\PostLike;
use App\Entity\BlogPost;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use Ramsey\Uuid\Uuid;

class BlogPostLiker
{
    /**
     * @var PostLikeRepository
     */
    private $postLikeRepository;
    /**
     * @var BlogPostRepository
     */
    private $BlogPostRepository;

    /**
     * @var Security  - dependency for getting a user
     */
    private $security;

    /**
     * @var PostLikeCounterManager  - dependency for increment or decrement likes_count
     */
    private $counterManager;

    /**
     * Constructor for initializing private variables.
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        Security $security
    ) {
        $this->postLikeRepository = $entityManager->getRepository(PostLike::class);
        $this->blogPostRepository = $entityManager->getRepository(BlogPost::class);
        $this->security = $security;
    }

    /**
     * like
     *
     * This function getting a user name inside and recieve post slug as a parameter,
     * then call writeLikeConnection() in LikeConnectionRepository and increments
     * the likes_count with PostLikeCounterManager's incrementLikeCoune()
     * @return void
     */
    public function like(BlogPost $post) : Void
    {
        $user = $this->security->getUser();
        $this->postLikeRepository->writeLike($user, $post);
        $this->blogPostRepository->incrementPostLikeCount($post);
    }

    /**
     * unlike
     *
     * This function getting a user name inside and recieve post slug as a parameter,
     * then call removeLikeConnection() in LikeConnectionRepository and decrements
     * the likes_count with PostLikeCounterManager's decrementLikeCoune()
     * @return void
     */
    public function unlike(BlogPost $post) : Void
    {
        $user = $this->security->getUser();

        $this->postLikeRepository->removeLike($user, $post);
        $this->blogPostRepository->decrementPostLikeCount($post);
    }

    /**
     * isLiked
     *
     * This function recieves user name and post slug to call
     * isLikeConnectionExtists() in LikeConnectionRepository, that checks
     * if the like note in table like_connection already exists with this
     * parameters and return true or false
     * @return boolean
     */
    public function isLiked(BlogPost $post) : Bool
    {
        if ($this->security->getUser()) {
            $user = $this->security->getUser();
            return $this->postLikeRepository->isLikeExtist($user, $post);
        } else {
            return false;
        }
    }
}
