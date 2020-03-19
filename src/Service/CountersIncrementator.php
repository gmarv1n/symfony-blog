<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

class CountersIncrementator
{
    private $repository = null;

    public function __construct(EntityManagerInterface $entityManager, $entityName)
    {
        $this->repository = $entityManager->getRepository($entityName);
    }
    public function incrementCounter($obj, $counterField) : Void
    {
        //$sendedClass = $obj->getClass();
        $counter = $obj->getLikesCounter();
        $counter++;
        $obj->setLikesCounter($counter);

        $some = $this->repository->$this->getDoctrine()->getManager();
        $some->persist($obj);
        $some->flush();
        //return new Response('<b>HERE WE ARE</b>'.$counterField.'<b>HERE WE ARE</b>');
    }
}