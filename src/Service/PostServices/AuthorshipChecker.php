<?php
/**
 * AuthorshipChecker Service
 * 
 * This class check if post is written by current logged in author
 * 
 * @author Gregory Yatsukhno <gyatsukhno@gmail.com>
 * @version 1.0
 */

namespace App\Service\PostServices;

use App\Entity\BlogPost;
use Symfony\Component\Security\Core\Security;

class AuthorshipChecker
{
    /**
     * @var Security $security
     */
    private $security;

    /**
     * Constructor for private variable $security
     */
    public function __construct(Security $security) 
    {
        $this->security = $security;
    }
    /**
     * isAuthor
     * 
     * This method checks is post written by logged in author
     * 
     * @param BlogPost $blogPost
     * 
     * @return Boolean
     */
    public function isAuthor(BlogPost $blogPost) : bool
    {
        if ( $this->security->getUser() ) {
            $userName = $this->security->getUser()->getUserName();
            $postAuthor = $blogPost->getAuthorName();

            if ( $userName === $postAuthor ) {
                return true;
            }
        }
        return false;
    }

}