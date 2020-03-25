<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Service\LikeServices\PostLiker;
use App\Service\LikeServices\PostLikeCounterManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\PostServices\PostFinder;
use App\Entity\LikeConnection;
use App\Repository\BlogPostRepository;
use Doctrine\ORM\Mapping\PostLoad;
use Symfony\Component\Routing\Annotation\Route;

class LikeConnectionController extends AbstractController
{
    /**
     * @Route("/create-like/{postSlug}", name="create_like")
     */
    public function likeThePost($postSlug, 
                                PostLiker $postLiker, 
                                PostLikeCounterManager $counterManager,
                                PostFinder $finder)
    {
        //This function must recieve a blogpost slig, current registered and logged
        //in user and make a note in LikeConnections db with user.name and post.slug
        $userName = $this->getUser()->getUserName();

        $postLiker->createPostLike($postSlug, $userName);
        $counterManager->incrementLikeCounter($postSlug);

        $likedPostId = $finder->getIdBySlug($postSlug);
        // $likedPostId = $this->getDoctrine()
        //                            ->getRepository(BlogPost::class)
        //                            ->findByPostSlugField($postSlug)
        //                            ->getId();
        
        return $this->redirectToRoute('blog_post_show', ['id' => $likedPostId]);
        
    }

    /**
     * @Route("/delete-like/{postSlug}", name="delete_like")
     */
    public function unLikeThePost($postSlug, 
                                  PostLiker $postLiker, 
                                  PostLikeCounterManager $counterManager,
                                  PostFinder $finder)
    {
        //This function must recieve a blogpost slug, current registered and logged
        //in user and remove a note from LikeConnections db where user.name and post.slug
        $userName = $this->getUser()->getUserName();

        $postLiker->removePostLike($postSlug, $userName);
        $counterManager->decrementLikeCounter($postSlug);

        $unLikedPostId = $finder->getIdBySlug($postSlug);

        // $unLikedPostId = $this->getDoctrine()
        //                        ->getRepository(BlogPost::class)
        //                        ->findByPostSlugField($postSlug)
        //                        ->getId();

        return $this->redirectToRoute('blog_post_show', ['id' => $unLikedPostId]);
        
    }
}
