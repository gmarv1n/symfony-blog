<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use DateTime;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
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
        $blogPost1->setAuthorName('test@test.com');
        $blogPost1->setLikesCounter(0);
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
        $blogPost2->setAuthorName('test@test.com');
        $blogPost2->setLikesCounter(0);
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
        $blogPost3->setAuthorName('test@test.com');
        $blogPost3->setLikesCounter(0);
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
        $blogPost4->setAuthorName('test@test.com');
        $blogPost4->setLikesCounter(0);
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
        $blogPost5->setAuthorName('test@test.com');
        $blogPost5->setLikesCounter(0);
        $blogPost5->setCommentsCount(0);
        $blogPost5->setDate($date);

        /**
         *   Generating comments for posts in table
         */
        // Put some comments to posts
        // Comment #1
        $comment1 = new Comment();
        $comment1->setUserName("test@test.com");
        $comment1->setPostSlug("post_one");
        $comment1->setComment('Everybody knows that this code SUCKS!');
        $comment1->setIsApproved(true);
        $comment1->setDate($date);

        // Comment #2
        $comment2 = new Comment();
        $comment2->setUserName("test@test.com");
        $comment2->setPostSlug("post_one");
        $comment2->setComment('Piece of shit! Everybody knows that this code SUCKS!');
        $comment2->setIsApproved(true);
        $comment2->setDate($date);

        // Comment #3
        $comment3 = new Comment();
        $comment3->setUserName("test@test.com");
        $comment3->setPostSlug("post_one");
        $comment3->setComment('Good but... Everybody knows that this code SUCKS!');
        $comment3->setIsApproved(true);
        $comment3->setDate($date);

        // Comment #4
        $comment4 = new Comment();
        $comment4->setUserName("test@test.com");
        $comment4->setPostSlug("post_one");
        $comment4->setComment('Lol! Everybody knows that this code SUCKS!');
        $comment4->setIsApproved(true);
        $comment4->setDate($date);

        // Comment #5
        $comment5 = new Comment();
        $comment5->setUserName("test@test.com");
        $comment5->setPostSlug("post_one");
        $comment5->setComment('Fuck you! Everybody knows that this code SUCKS!');
        $comment5->setIsApproved(true);
        $comment5->setDate($date);

        // Comment #6
        $comment6 = new Comment();
        $comment6->setUserName("test@test.com");
        $comment6->setPostSlug("fifth-post");
        $comment6->setComment('Thank you for your consideration. Everybody knows that this code SUCKS!');
        $comment6->setIsApproved(true);
        $comment6->setDate($date);

        // Comment #7
        $comment7 = new Comment();
        $comment7->setUserName("test@test.com");
        $comment7->setPostSlug("post_one");
        $comment7->setComment('I appologise, but... Everybody knows that this code SUCKS!');
        $comment7->setIsApproved(true);
        $comment7->setDate($date);

        // Comment #8
        $comment8 = new Comment();
        $comment8->setUserName("test@test.com");
        $comment8->setPostSlug("post_one");
        $comment8->setComment('Nope! Everybody knows that this code SUCKS!');
        $comment8->setIsApproved(true);
        $comment8->setDate($date);

        // Comment #9
        $comment9 = new Comment();
        $comment9->setUserName("test@test.com");
        $comment9->setPostSlug("fifth-post");
        $comment9->setComment('Hi everyone! Everybody knows that this code SUCKS!');
        $comment9->setIsApproved(true);
        $comment9->setDate($date);

        $manager->persist($blogPost1);
        $manager->persist($blogPost2);
        $manager->persist($blogPost3);
        $manager->persist($blogPost4);
        $manager->persist($blogPost5);

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
}
