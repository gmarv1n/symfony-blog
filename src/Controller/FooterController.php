<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FooterController extends AbstractController
{
    /**
     * This controller needs no routing, controller generate all needed footer content and renders it.
     */
    public function renderFooter()
    {
        return $this->render('_footer.html.twig', [
            'controller_footer' => 'FooterController',
        ]);
    }
}
