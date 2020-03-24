<?php

namespace App\Service\LikeServices;
use App\Service\LikeServices\PostLiker;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class LikeUrlGenerator

{
    private $router;
    private $postLiker;

    public function __construct(UrlGeneratorInterface $router, PostLiker $postLiker)
    {
        $this->router = $router;
        $this->postLiker = $postLiker;
    }

    public function generateLikeUrl(string $postSlug, string $userName, int $blogPostId) : Array
    {
        $urlArray = [];
        $isAlreadyLiked = $this->postLiker->isLiked($userName, $postSlug);

        if ( $isAlreadyLiked ) {
            $urlArray['urlText'] = "Unlike!";
            $urlArray['url'] = $this->router->generate('blog_post_unlike', ['id' => $blogPostId]);
        } if ( !$isAlreadyLiked ) {
            $urlArray['urlText'] = "Like!";
            $urlArray['url'] = $this->router->generate('blog_post_like', ['id' => $blogPostId]);
        }
        return $urlArray;
    }
}
