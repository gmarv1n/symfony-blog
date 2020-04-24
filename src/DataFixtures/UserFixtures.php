<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use App\Entity\Comment;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use DateTime;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        /**
         *   Generating posts in table
         */

        $date = new DateTime('2020-06-03');

        // Putting some users 
        // User 1
        $user1 = new User();
        $user1->setUserNickName("Gregory");
        $user1->setRoles(["ROLE_ADMIN"]);
        $user1->setEmail("admin@mail.com");
        $user1->setPassword($this->passwordEncoder->encodePassword(
            $user1,
            '123654'
        ));

        // User 2
        $user2 = new User();
        $user2->setUserNickName("Vovochka");
        $user2->setEmail("vovan@mail.com");
        $user2->setPassword($this->passwordEncoder->encodePassword(
            $user2,
            '123654'
        ));

        $manager->persist($user1);
        $manager->persist($user2);

        $manager->flush();
    }
}
