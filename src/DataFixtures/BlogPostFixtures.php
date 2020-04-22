<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use App\Entity\Comment;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use DateTime;
use App\DataFixtures\UserFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Repository\UserRepository;

class BlogPostFixtures extends Fixture implements DependentFixtureInterface
{
    private $passwordEncoder;
    private $userRepository;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, UserRepository $userRepository)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->userRepository = $userRepository;
    }

    public function load(ObjectManager $manager)
    {
        $users = $this->userRepository->findAll();

        /**
         *   Generating posts in table
         */

        $date = new DateTime('2020-06-03');

        // Putting some random data for blog posts
        // Post 1
        $blogPost1 = new BlogPost();
        $blogPost1->setTitle('Post in blog #1');
        $blogPost1->setSlug('post_one');
        $blogPost1->setShortContent('Post ine short content...');
        $blogPost1->setContent('Post one content is lorem ipsum dolor huelor bla bla bla finally thats it.');
        $blogPost1->setCategory('blogpost');
        $blogPost1->setTags('tags, for, testing');
        $blogPost1->setAuthorNick($users[0]->getUserNickName());
        $blogPost1->setAuthorId($users[0]->getId());
        $blogPost1->setLikesCount(0);
        $blogPost1->setCommentsCount(0);
        $blogPost1->setDate($date);

        // Putting some random data for blog posts
        // Post 2
        $blogPost2 = new BlogPost();
        $blogPost2->setTitle('Post in blog #2');
        $blogPost2->setSlug('post_two');
        $blogPost2->setShortContent('Post two short content...');
        $blogPost2->setContent('Post two content is lorem ipsum dolor huelor bla bla bla finally thats it.');
        $blogPost2->setCategory('article');
        $blogPost2->setTags('tags, for, testing');
        $blogPost2->setAuthorNick($users[0]->getUserNickName());
        $blogPost2->setAuthorId($users[0]->getId());
        $blogPost2->setLikesCount(0);
        $blogPost2->setCommentsCount(0);
        $blogPost2->setDate($date);

        // Putting some random data for blog posts
        // Post 3
        $blogPost3 = new BlogPost();
        $blogPost3->setTitle('#3 blog in psot');
        $blogPost3->setSlug('post_three');
        $blogPost3->setShortContent('Post three short content...');
        $blogPost3->setContent('Post 3 content is lorem ipsum dolor huelor bla bla bla finally thats it.');
        $blogPost3->setCategory('thoughts');
        $blogPost3->setTags('tags, for, testing');
        $blogPost3->setAuthorNick($users[0]->getUserNickName());
        $blogPost3->setAuthorId($users[0]->getId());
        $blogPost3->setLikesCount(0);
        $blogPost3->setCommentsCount(0);
        $blogPost3->setDate($date);

        // Putting some random data for blog posts
        // Post 4
        $blogPost4 = new BlogPost();
        $blogPost4->setTitle('In #4 post blog');
        $blogPost4->setSlug('four');
        $blogPost4->setShortContent('4th post short content...');
        $blogPost4->setContent('Post 4 content is lorem ipsum dolor huelor bla bla bla finally thats it.');
        $blogPost4->setCategory('living');
        $blogPost4->setTags('tags, for, testing');
        $blogPost4->setAuthorNick($users[1]->getUserNickName());
        $blogPost4->setAuthorId($users[1]->getId());
        $blogPost4->setLikesCount(0);
        $blogPost4->setCommentsCount(0);
        $blogPost4->setDate($date);

        // Putting some random data for blog posts
        // Post 5
        $blogPost5 = new BlogPost();
        $blogPost5->setTitle('THE FIFTH');
        $blogPost5->setSlug('fifth-post');
        $blogPost5->setShortContent('Finally 5 post');
        $blogPost5->setContent('Post 5 content is lorem ipsum dolor huelor bla bla bla finally thats it.');
        $blogPost5->setCategory('coding');
        $blogPost5->setTags('tags, for, testing');
        $blogPost5->setAuthorNick($users[1]->getUserNickName());
        $blogPost5->setAuthorId($users[1]->getId());
        $blogPost5->setLikesCount(0);
        $blogPost5->setCommentsCount(0);
        $blogPost5->setDate($date);

        $manager->persist($blogPost1);
        $manager->persist($blogPost2);
        $manager->persist($blogPost3);
        $manager->persist($blogPost4);
        $manager->persist($blogPost5);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}
