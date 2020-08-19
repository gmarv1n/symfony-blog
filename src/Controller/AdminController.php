<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 * IsGranted("ROLE_ADMIN")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/index", name="admin_index")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/posts", name="admin_posts")
     */
    public function showPosts()
    {
        return $this->render('admin/posts_list.html.twig', [
            'controller_name' => 'PostList',
        ]);
    }

    /**
     * @Route("/comments", name="admin_comments")
     */
    public function showComments()
    {
        return $this->render('admin/comments_list.html.twig', [
            'controller_name' => 'CommentsList',
        ]);
    }

    /**
     * @Route("/users", name="admin_users")
     */
    public function showUsers()
    {
        return $this->render('admin/users_list.html.twig', [
            'controller_name' => 'UsersList',
        ]);
    }
}
