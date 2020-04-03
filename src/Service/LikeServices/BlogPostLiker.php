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

use App\Entity\LikeConnection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use App\Service\LikeServices\PostLikeCounterManager;

class BlogPostLiker
{
    /**
     * @var LikeConnectionRepository - dependency for using LikeConnectionRepository methods
     */
    private $repository;

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
    public function __construct(EntityManagerInterface $entityManager, 
                                Security $security, 
                                PostLikeCounterManager $counterManager)
    {
        $this->repository = $entityManager->getRepository(LikeConnection::class);
        $this->security = $security;
        $this->counterManager = $counterManager;
    }

    /**
     * like
     * 
     * This function getting a user name inside and recieve post slug as a parameter,
     * then call writeLikeConnection() in LikeConnectionRepository and increments
     * the likes_count with PostLikeCounterManager's incrementLikeCoune()
     * 
     * @param string $postSlug - the slig of post wich is being liking
     * 
     * @return void
     */
    public function like(string $postSlug) : Void
    {
        $userName = $this->security->getUser()->getUserName();
        $this->repository->writeLikeConnection($userName, $postSlug);
        $this->counterManager->incrementLikeCount($postSlug);
    }

    /**
     * unlike
     * 
     * This function getting a user name inside and recieve post slug as a parameter,
     * then call removeLikeConnection() in LikeConnectionRepository and decrements
     * the likes_count with PostLikeCounterManager's decrementLikeCoune()
     * 
     * @param string $postSlug - the slig of post wich is being liking
     * 
     * @return void
     */
    public function unlike(string $postSlug) : Void
    {
        $userName = $this->security->getUser()->getUserName();
        $this->repository->removeLikeConnection($userName, $postSlug);
        $this->counterManager->decrementLikeCount($postSlug);
    }

    /**
     * isLiked
     * 
     * This function recieves user name and post slug to call
     * isLikeConnectionExtists() in LikeConnectionRepository, that checks 
     * if the like note in table like_connection already exists with this
     * parameters and return true or false
     * 
     * @param string $postSlug - the slug of post wich is being liking
     * 
     * @return boolean
     */
    public function isLiked(string $postSlug) : Bool
    {
        $userName = $this->security->getUser()->getUserName();

        return $this->repository->isLikeConnectionExtists($userName, $postSlug);
    }
}