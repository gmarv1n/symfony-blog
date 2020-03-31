<?php
/**
 * LikeConnectionController
 * 
 * This is the controller for LikeConnection entity. It create and remove like of
 * the selected post. Methods stores Like Connections in like_connection table 
 * 
 * @author Gregory Yatsukhno <gyatsukhno@gmail.com>
 * @version 1.0
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\LikeServices\PostLiker;
use App\Service\LikeServices\PostLikeCounterManager;
use App\Service\PostServices\PostFinder;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LikeConnectionController extends AbstractController
{
    /**
     * @Route("/create-like", name="create_like")
     * 
     * likeThePost
     * 
     * This function resieves $request object and get 'postSlug' property from
     * POST. By using PostLiker, PostCounterManager and PostFinder services, 
     * function initialize $postSlug variable from POST, then get the logged in 
     * @userName, create likeConnection with PostLiker, increments the likes_count
     * field with PostLikeCounterManager, get the likedPostId with PostFinder and return 
     * RedicretResponse wich redirect back to the post.
     * 
     * @param Request $request
     * @param PostLiker $postLiker
     * @param PostLikeCounterManager $counterManager
     * @param PostFinder $finder
     * 
     * @return RedirectResponse
     */
    public function likeThePost(Request $request, 
                                PostLiker $postLiker, 
                                PostLikeCounterManager $counterManager,
                                PostFinder $finder) : RedirectResponse
    {

        $postSlug = $request->get('postSlug');

        $userName = $this->getUser()->getUserName();

        $postLiker->like($postSlug, $userName);

        $counterManager->incrementLikeCount($postSlug);

        $likedPostId = $finder->getIdBySlug($postSlug);
        
        return $this->redirectToRoute('blog_post_show', ['id' => $likedPostId]);
        
    }

    /**
     * @Route("/delete-like", name="delete_like")
     * 
     * unLikeThePost
     * 
     * This function resieves $request object and get 'postSlug' property from
     * POST. By using PostLiker, PostCounterManager and PostFinder services, 
     * function initialize $postSlug variable from POST, then get the logged in 
     * @userName, remove likeConnection with PostLiker, deccrements the likes_count
     * field with PostLikeCounterManager, get the likedPostId with PostFinder and return 
     * RedicretResponse wich redirect back to the post.
     * 
     * @param Request $request
     * @param PostLiker $postLiker
     * @param PostLikeCounterManager $counterManager
     * @param PostFinder $finder
     * 
     * @return RedirectResponse
     */
    public function unLikeThePost(Request $request, 
                                  PostLiker $postLiker, 
                                  PostLikeCounterManager $counterManager,
                                  PostFinder $finder) : RedirectResponse
    {

        $postSlug = $request->get('postSlug');

        $userName = $this->getUser()->getUserName();

        $postLiker->unlike($postSlug, $userName);
        
        $counterManager->decrementLikeCount($postSlug);

        $unLikedPostId = $finder->getIdBySlug($postSlug);

        return $this->redirectToRoute('blog_post_show', ['id' => $unLikedPostId]);
        
    }
}
