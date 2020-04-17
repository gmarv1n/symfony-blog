<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Form\BlogPostType;
use App\Repository\BlogPostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\LikeServices\LikeUrlGenerator;
use App\Service\PostServices\AuthorshipChecker;
use App\Service\LikeServices\BlogPostLiker;

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
     * @Route("/{slug}", name="blog_post_show", methods={"GET"})
     */
    public function show(BlogPost $blogPost, LikeUrlGenerator $likeUrlGenerator/*, AuthorshipChecker $authorshipChecker */): Response
    {
        
        $postSlug = $blogPost->getSlug();
        $blogPostId = $blogPost->getId();

        $likeUrl = $likeUrlGenerator->generateLikeUrl($postSlug, $blogPostId);

        // $isAuthor variable recieve re result of AuthorShipChecker's method isAuthor() and
        // send it to a view as 'isAuthor' wich is uses in logic inside of view to show or not
        // to show the delete button and edit button, so just the author of post (and admin) 
        // can delete the post

        // $isAuthor = $authorshipChecker->isAuthor($blogPost);

        return $this->render('blog_post/show.html.twig', [
            'blog_post'     => $blogPost, 
            'like_post_url' => $likeUrl['url'], 
            'likeUrlText'   => $likeUrl['urlText'],
            //'isAuthor'      => $isAuthor
        ]);
    }

    /**
     * @Route("/{slug}/edit", name="blog_post_edit", methods={"GET","POST"})
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
     * @Route("/{slug}", name="blog_post_delete", methods={"DELETE"})
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
     * @Route("/{slug}/like", name="blog_post_like", methods={"GET"})
     */
    public function like(BlogPost $blogPost, BlogPostLiker $liker): Response
    {   
        $postId = $blogPost->getId();
        $liker->like($postId);
        
        return $this->redirectToRoute('blog_post_show', ['slug' => $blogPost->getSlug()]);
    }

    /** 
     * @Route("/{slug}/unlike", name="blog_post_unlike", methods={"GET"})
     */
    public function unlike(BlogPost $blogPost, BlogPostLiker $liker): Response
    {
        $postId = $blogPost->getId();
        $liker->unlike($postId);
        
        return $this->redirectToRoute('blog_post_show', ['slug' => $blogPost->getSlug()]);
    }

}
