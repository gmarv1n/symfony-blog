<?php

namespace App\Controller;

use App\Entity\BlogPost;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\LikeConnection;
use App\Repository\BlogPostRepository;
use Symfony\Component\Routing\Annotation\Route;

class LikeConnectionController extends AbstractController
{
    /**
     * @Route("/create-like/{postSlug}", name="create_like")
     */
    public function likeThePost($postSlug)
    {
        //This function must recieve a blogpost slig, current registered and logged
        //in user and make a note in LikeConnections db with user.name and post.slug
        $user = $this->getUser();

        $likeConnection = new LikeConnection();
        $likeConnection->setPostSlug($postSlug);
        $likeConnection->setUserName($user->getUsername());

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($likeConnection);
        $entityManager->flush();

        $likedPostArr = $this->getDoctrine()
                                   ->getRepository(BlogPost::class)
                                   ->findByPostSlugField($postSlug);

        $likedPostId = $likedPostArr->getId();
        
        return $this->redirectToRoute('blog_post_show', ['id' => $likedPostId]);
        
    }

    /**
     * @Route("/delete-like/{postSlug}", name="delete_like")
     */
    public function unLikeThePost($postSlug)
    {
        //This function must recieve a blogpost slug, current registered and logged
        //in user and remove a note from LikeConnections db where user.name and post.slug
        $user = $this->getUser();
        $userName = $user->getUsername();
        $unLikedPost = $this->getDoctrine()
                               ->getRepository(BlogPost::class)
                               ->findByPostSlugField($postSlug);
        $unLikedPostSlug = $unLikedPost->getSlug();

        $likeConnection = $this->getDoctrine()
                               ->getRepository(LikeConnection::class)
                               ->getLikeConnection($unLikedPostSlug, $userName);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($likeConnection);
        $entityManager->flush();

        $likedPostId = $unLikedPost->getId();
        
        return $this->redirectToRoute('blog_post_show', ['id' => $likedPostId]);
        
    }
}
