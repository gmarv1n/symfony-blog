<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogListController extends AbstractController
{
    /**
     * @Route("/blog/list", name="blog_list")
     */
    public function index()
    {
        return $this->render('blog_list/index.html.twig', [
            'controller_name' => 'BlogListController',
        ]);
    }
}
