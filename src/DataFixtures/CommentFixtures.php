<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use App\Entity\Comment;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use DateTime;
use App\DataFixtures\BlogPostFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Repository\UserRepository;
use App\Repository\BlogPostRepository;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    private $passwordEncoder;
    private $userRepository;
    private $blogPostRepository;

    public function __construct(
        UserPasswordEncoderInterface $passwordEncoder,
        UserRepository $userRepository,
        BlogPostRepository $blogPostRepository
    ) {
        $this->passwordEncoder = $passwordEncoder;
        $this->userRepository = $userRepository;
        $this->blogPostRepository = $blogPostRepository;
    }

    public function load(ObjectManager $manager)
    {
        $date = new DateTime('2020-06-03');

        $users = $this->userRepository->findAll();
        $blogPosts = $this->blogPostRepository->findAll();

        /**
         *   Generating comments for posts in table
         */
        // Put some comments to posts
        // Comment #1
        $comment1 = new Comment();
        $comment1->setAuthorId($users[0]->getId());
        $comment1->setPostId($blogPosts[0]->getId());
        $comment1->setComment('Everybody knows that this code SUCKS!');
        $comment1->setIsApproved(true);
        $comment1->setDate($date);

        // Comment #2
        $comment2 = new Comment();
        $comment2->setAuthorId($users[0]->getId());
        $comment2->setPostId($blogPosts[0]->getId());
        $comment2->setComment('Piece of shit! Everybody knows that this code SUCKS!');
        $comment2->setIsApproved(true);
        $comment2->setDate($date);

        // Comment #3
        $comment3 = new Comment();
        $comment3->setAuthorId($users[1]->getId());
        $comment3->setPostId($blogPosts[3]->getId());
        $comment3->setComment('Good but... Everybody knows that this code SUCKS!');
        $comment3->setIsApproved(true);
        $comment3->setDate($date);

        // Comment #4
        $comment4 = new Comment();
        $comment4->setAuthorId($users[1]->getId());
        $comment4->setPostId($blogPosts[4]->getId());
        $comment4->setComment('Lol! Everybody knows that this code SUCKS!');
        $comment4->setIsApproved(true);
        $comment4->setDate($date);

        // Comment #5
        $comment5 = new Comment();
        $comment5->setAuthorId($users[0]->getId());
        $comment5->setPostId($blogPosts[2]->getId());
        $comment5->setComment('Fuck you! Everybody knows that this code SUCKS!');
        $comment5->setIsApproved(true);
        $comment5->setDate($date);

        // Comment #6
        $comment6 = new Comment();
        $comment6->setAuthorId($users[0]->getId());
        $comment6->setPostId($blogPosts[1]->getId());
        $comment6->setComment('Thank you for your consideration. Everybody knows that this code SUCKS!');
        $comment6->setIsApproved(true);
        $comment6->setDate($date);

        // Comment #7
        $comment7 = new Comment();
        $comment7->setAuthorId($users[0]->getId());
        $comment7->setPostId($blogPosts[0]->getId());
        $comment7->setComment('I appologise, but... Everybody knows that this code SUCKS!');
        $comment7->setIsApproved(true);
        $comment7->setDate($date);

        // Comment #8
        $comment8 = new Comment();
        $comment8->setAuthorId($users[1]->getId());
        $comment8->setPostId($blogPosts[2]->getId());
        $comment8->setComment('Nope! Everybody knows that this code SUCKS!');
        $comment8->setIsApproved(true);
        $comment8->setDate($date);

        // Comment #9
        $comment9 = new Comment();
        $comment9->setAuthorId($users[0]->getId());
        $comment9->setPostId($blogPosts[2]->getId());
        $comment9->setComment('Hi everyone! Everybody knows that this code SUCKS!');
        $comment9->setIsApproved(true);
        $comment9->setDate($date);

        $manager->persist($comment1);
        $manager->persist($comment2);
        $manager->persist($comment3);
        $manager->persist($comment4);
        $manager->persist($comment5);
        $manager->persist($comment6);
        $manager->persist($comment7);
        $manager->persist($comment8);
        $manager->persist($comment9);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            BlogPostFixtures::class,
        );
    }
}
