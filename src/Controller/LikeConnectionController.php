<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\LikeConnection;
use App\Repository\LikeConnectionRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\BlogPost;
use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;

class LikeConnectionController extends AbstractController
{
    /**
     * @Route("/create-like/{postSlug}", name="like_the_post")
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

        //$entityManager = $this->container->get('doctrine')->getManager();
        $entityManager->persist($likeConnection);
        $entityManager->flush();

        return $this->redirectToRoute('blog_post_index');
    }
}
