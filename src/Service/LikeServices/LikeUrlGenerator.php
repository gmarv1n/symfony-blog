<?php

namespace App\Service\LikeServices;
use App\Service\LikeServices\PostLiker;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Security;

class LikeUrlGenerator

{
    private $router;
    private $postLiker;
    private $security;

    public function __construct(UrlGeneratorInterface $router, PostLiker $postLiker, Security $security)
    {
        $this->router = $router;
        $this->postLiker = $postLiker;
        $this->security = $security;
    }

    public function generateLikeUrl(string $postSlug, string $blogPostId) : Array
    {
        $userName = null;
        $urlArray = [];
        if ( $this->security->getUser() ) {
            $userName =$this->security->getUser()->getUserName();
            
            $isAlreadyLiked = $this->postLiker->isLiked($userName, $postSlug);

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
