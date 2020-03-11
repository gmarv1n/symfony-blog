<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Entity\LikeConnections;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\LikeConnectionsRepository;

class LikeConnectionsController extends AbstractController
{
    /**
     * @Route("/likethepost", name="like_post")
     */
    public function likeThePost(BlogPost $post, User $user)
    {
        //This function must recieve a blogpost object, current registered and logged
        //in user and make a note in LikeConnections db with user.name and post.slug
        $likeConnection = new LikeConnections();
        $likeConnection->setPostSlug($post->getSlug());
        $likeConnection->setUserName($user->getUsername());

        //$entityManager = $this->getDoctrine()->getManager();
        $entityManager = $this->container->get('doctrine')->getManager();
        $entityManager->persist($likeConnection);
        $entityManager->flush();

        return true;
        // return $this->render('like_connections/index.html.twig', [
        //     'controller_name' => 'LikeConnectionsController',
        // ]);
    }
}
