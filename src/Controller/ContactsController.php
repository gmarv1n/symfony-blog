<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContactsController extends AbstractController
{
    /**
     * @Route("/contacts", name="contacts_page")
     */
    public function renderContactsPage()
    {
        return $this->render('contacts.html.twig', [
            'controller_name' => 'ContactsController',
        ]);
    }
}
