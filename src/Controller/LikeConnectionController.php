<?php

namespace App\Controller;


use App\Service\LikeServices\PostLiker;
use App\Service\LikeServices\PostLikeCounterManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\PostServices\PostFinder;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;

class LikeConnectionController extends AbstractController
{
    
    /**
     * @Route("/create-like", name="create_like")
     */
    public function likeThePost(Request $request, 
                                PostLiker $postLiker, 
                                PostLikeCounterManager $counterManager,
                                PostFinder $finder)
    {
        //This function must recieve a blogpost slig, current registered and logged
        //in user and make a note in LikeConnections db with user.name and post.slug

        $postSlug = $request->get('postSlug');

        $userName = $this->getUser()->getUserName();

        $postLiker->like($postSlug, $userName);

        $counterManager->incrementLikeCounter($postSlug);

        $likedPostId = $finder->getIdBySlug($postSlug);
        
        return $this->redirectToRoute('blog_post_show', ['id' => $likedPostId]);
        
    }

    /**
     * @Route("/delete-like", name="delete_like")
     */
    public function unLikeThePost(Request $request, 
                                  PostLiker $postLiker, 
                                  PostLikeCounterManager $counterManager,
                                  PostFinder $finder)
    {
        //This function must recieve a blogpost slug, current registered and logged
        //in user and remove a note from LikeConnections db where user.name and post.slug

        $postSlug = $request->get('postSlug');

        $userName = $this->getUser()->getUserName();

        $postLiker->unlike($postSlug, $userName);
        
        $counterManager->decrementLikeCounter($postSlug);

        $unLikedPostId = $finder->getIdBySlug($postSlug);

        return $this->redirectToRoute('blog_post_show', ['id' => $unLikedPostId]);
        
    }
}
