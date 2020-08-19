<?php

namespace App\Controller;

use PhpParser\Node\Expr\Cast\Array_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HeaderController extends AbstractController
{
    /**
     * This controller needs no routing, controller generate all needed header content and renders it.
     */
    public function renderHeader()
    {
        $mainMenu = $this->generateMainMenuLinks();

        // generating login, logout and register links
        $loginLink    = $this->generateUrl('site_login');
        $logoutLink   = $this->generateUrl('site_logout');
        $registerLink = $this->generateUrl('site_register');

        return $this->render('_header.html.twig', [
            'mainMenu' => $mainMenu,
            'controller_header' => 'HeaderController',
            'login_link' => $loginLink,
            'logout_link' => $logoutLink,
            'register_link' => $registerLink
        ]);
    }

    // This function generates main menu links

    public function generateMainMenuLinks() : array
    {
        //initializing array
        $mainMenuLinks = [];
        $mainMenuLinks["About"]    = $this->generateUrl('about_page');
        $mainMenuLinks["Contacts"] = $this->generateUrl('contacts_page');
        $mainMenuLinks["Blog"]     = $this->generateUrl('blog_post_index');
        return $mainMenuLinks;
    }
}
