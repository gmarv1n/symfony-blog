<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    /**
     * @Route("/about", name="about_page")
     */
    public function renderAboutPage()
    {
        return $this->render('about.html.twig', [
            'controller_name' => 'AboutController',
        ]);
    }
}
