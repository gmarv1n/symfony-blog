<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;

class CountersIncrementator
{
    public function incrementCounter($obj, $counterField) : Void
    {
        //$sendedClass = $obj->getClass();
        $counter = $obj->getLikesCounter();
        $counter++;

        $queryBuilder = $obj->getRepository()->createQueryBuilder('u');
        $queryBuilder->update()
            ->set('u.likes_counter', $counter)
            ->getQuery()
            ->execute();

        //return new Response('<b>HERE WE ARE</b>'.$counterField.'<b>HERE WE ARE</b>');
    }
}