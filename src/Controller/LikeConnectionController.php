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
        //This function must recieve a blogpost object, current registered and logged
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

        $likedPostId = $likedPostArr[0]->getId();
        

        return $this->redirectToRoute('blog_post_show', ['id' => $likedPostId]);
        //return $this->redirectToRoute('blog_post_index');
    }
}
