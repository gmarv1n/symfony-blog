<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Form\BlogPostType;
use App\Repository\BlogPostRepository;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\LikeConnectionController;

/**
 * @Route("/blog")
 */
class BlogPostController extends AbstractController
{
    /**
     * @Route("/", name="blog_post_index", methods={"GET"})
     */
    public function index(BlogPostRepository $blogPostRepository): Response
    {
        return $this->render('blog_post/index.html.twig', [
            'blog_posts' => $blogPostRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="blog_post_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $blogPost = new BlogPost();
        $form = $this->createForm(BlogPostType::class, $blogPost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($blogPost);
            $entityManager->flush();

            return $this->redirectToRoute('blog_post_index');
        }

        return $this->render('blog_post/new.html.twig', [
            'blog_post' => $blogPost,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="blog_post_show", methods={"GET"})
     */
    public function show(BlogPost $blogPost): Response
    {
        // Generate url for LikeConnection 
        $blogPostId = $blogPost->getId();
        $likeUrl = $this->generateUrl('blog_post_like', ['id' => $blogPostId]);

        return $this->render('blog_post/show.html.twig', [
            'blog_post' => $blogPost, 'like_post' => $likeUrl
        ]);
    }

    /**
     * @Route("/{id}/edit", name="blog_post_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, BlogPost $blogPost): Response
    {
        $form = $this->createForm(BlogPostType::class, $blogPost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('blog_post_index');
        }

        return $this->render('blog_post/edit.html.twig', [
            'blog_post' => $blogPost,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="blog_post_delete", methods={"DELETE"})
     */
    public function delete(Request $request, BlogPost $blogPost): Response
    {
        if ($this->isCsrfTokenValid('delete'.$blogPost->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($blogPost);
            $entityManager->flush();
        }

        return $this->redirectToRoute('blog_post_index');
    }

    /**
     * @Route("/{id}/like", name="blog_post_like", methods={"GET"})
     */
    public function like(BlogPost $blogPost): Response
    {
        // This function call the like_the_post route in LikeConnection controller   
        
        // Getting a @string postSlug from blogPost obj
        $postSlug = $blogPost->getSlug();
        // Getting a postId field of obj for the second argment
        $postId = $blogPost->getId();
        $this->incrementLikeCounter($blogPost);
        return $this->redirectToRoute('create_like', ['postSlug' => $postSlug]);
    }

    public function incrementLikeCounter(BlogPost $blogPost) : void
    {
        // This function increments like counter field
        $postLikesCounter = $blogPost->getLikesCounter();
        $postLikesCounter++;
        $blogPost->setLikesCounter($postLikesCounter);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($blogPost);
        $entityManager->flush();
    } 
}
