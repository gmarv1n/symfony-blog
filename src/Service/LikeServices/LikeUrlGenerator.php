<?php
/**
 * LikeUrlGenerator Service
 * 
 * This class generates 'like url' in BlogPostController depending on user authorization
 * and like existense in likeconnection table. If user is authorized - like button become 
 * available and if user already liked the post, url switch to unlike.
 * 
 * @author Gregory Yatsukhno <gyatsukhno@gmail.com>
 * @version 1.0
 */

namespace App\Service\LikeServices;

use App\Service\LikeServices\BlogPostLiker;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Security;
class LikeUrlGenerator
{
    /**
     * @var UrlGeneratorInterface - dependency for generating url
     */
    private $router;

    /**
     * @var BlogPostLiker - dependency for checking like connection existence
     */
    private $blogPostLiker;

    /**
     * @var Security  - dependency for getting a user
     */
    private $security;

    /**
     * Constructor for initializing private variables.
     */
    public function __construct(UrlGeneratorInterface $router, BlogPostLiker $blogPostLiker, Security $security)
    {
        $this->router = $router;
        $this->blogPostLiker = $blogPostLiker;
        $this->security = $security;
    }

    /**
     * generateLikeUrl
     * 
     * This function return array with url and text for url. Function recieve post_slug 
     * and id of blogpost, check if user not null, then check if like_connection with this user
     * and post_slug exist and push 'urlText' and 'url' to an array and returns it.
     * If user don't logged in, in returns url dummy, wich not go to the 'show' template cause of
     * template logic. Function uses constructed $router to generat() method, @postLiker to check
     * the like existence with method isLike() and $security to get (or not) user.
     * 
     * @param string @postSlug post_slug field
     * @param string @blogPostId id of blog post for url generator
     * 
     * @return array @urlArray['urlText' => 'Like/Unlike', 'url' => '/blog/id/like(unlike)']
     */
    public function generateLikeUrl(string $postSlug, string $blogPostId) : Array
    {
        $urlArray = [];
        if ( $this->security->getUser() ) {
            $userName =$this->security->getUser()->getUserName();
            
            $isAlreadyLiked = $this->blogPostLiker->isLiked($postSlug);

            if ( $isAlreadyLiked ) {
                $urlArray['urlText'] = "Unlike!";
                $urlArray['url'] = $this->router->generate('blog_post_unlike', ['id' => $blogPostId]);
            } if ( !$isAlreadyLiked ) {
                $urlArray['urlText'] = "Like!";
                $urlArray['url'] = $this->router->generate('blog_post_like', ['id' => $blogPostId]);
            }
            return $urlArray;
        } else {
            $urlArray['urlText'] = "Like!";
            $urlArray['url'] = '#';

            return $urlArray;
        }
    }
}
