<?php
/**
 * PostLiker Service
 * 
 * This class manage the creating a LikeConnection in database for the selected post.
 * It uses in LikeUrlGenerator and LikeConnection controller.
 * 
 * @author Gregory Yatsukhno <gyatsukhno@gmail.com>
 * @version 1.0
 */

namespace App\Service\LikeServices;

use App\Entity\LikeConnection;
use Doctrine\ORM\EntityManagerInterface;

class PostLiker
{
    /**
     * @var BlopGostRepository - dependency for using LikeConnectionRepository methods
     */
    private $repository = null;

    /**
     * Constructor for initializing private variables.
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(LikeConnection::class);
    }

    /**
     * like
     * 
     * This function recieves user name and post slug to call
     * writeLikeConnection() in LikeConnectionRepository, that writes 
     * the like note in table like_connection
     * 
     * @param string $userName - the email of logged user
     * @param string $postSlug - the slig of post wich is being liking
     * 
     * @return void
     */
    public function like(string $userName, string $postSlug) : Void
    {
        $this->repository->writeLikeConnection($userName, $postSlug);
    }

    /**
     * unlike
     * 
     * This function recieves user name and post slug to call
     * removeLikeConnection() in LikeConnectionRepository, that removes 
     * the like note in table like_connection
     * 
     * @param string $userName - the email of logged user
     * @param string $postSlug - the slig of post wich is being liking
     * 
     * @return void
     */
    public function unlike(string $userName, string $postSlug) : Void
    {
        $this->repository->removeLikeConnection($userName, $postSlug);
    }

    /**
     * isLiked
     * 
     * This function recieves user name and post slug to call
     * isLikeConnectionExtists() in LikeConnectionRepository, that checks 
     * if the like note in table like_connection already exists with this
     * parameters and return true or false
     * 
     * @param string $userName - the email of logged user
     * @param string $postSlug - the slig of post wich is being liking
     * 
     * @return boolean
     */
    public function isLiked(string $userName, string $postSlug) : Bool
    {
        return $this->repository->isLikeConnectionExtists($userName, $postSlug);;
    }
}