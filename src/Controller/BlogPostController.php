<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Form\BlogPostType;
use App\Form\Admin\AdminBlogPostType;
use App\Repository\BlogPostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\PostServices\AuthorshipChecker;
use App\Service\LikeServices\BlogPostLiker;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Ramsey\Uuid\Uuid;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Entity\User;

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
     * @Route("/", name="blog_post_admin_index", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function adminIndex(BlogPostRepository $blogPostRepository): Response
    {
        return $this->render('blog_post/admin/index.html.twig', [
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
     * @Route("/new-by-admin", name="blog_post_admin_new", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function adminNew(Request $request): Response
    {
        $blogPost = new BlogPost();
        $form = $this->createForm(AdminBlogPostType::class, $blogPost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($blogPost);
            $entityManager->flush();

            return $this->redirectToRoute('admin_posts');
        }

        return $this->render('blog_post/admin/new.html.twig', [
            'blog_post' => $blogPost,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="blog_post_show", methods={"GET"})
     */
    public function show(
        BlogPost $blogPost,
        BlogPostLiker $liker,
        AuthorshipChecker $authorshipChecker,
        SessionInterface $session
    ): Response {
        $postSlug = $blogPost->getSlug();
        $postId = $blogPost->getId();

        $likeToken = Uuid::uuid4();
        $session->set('likeToken', $likeToken);

        $isAlreadyLiked = $liker->isLiked($blogPost);

        // $isAuthor variable recieve re result of AuthorShipChecker's method isAuthor() and
        // send it to a view as 'isAuthor' wich is uses in logic inside of view to show or not
        // to show the delete button and edit button, so just the author of post (and admin)
        // can delete the post

        $isAuthor = $authorshipChecker->isAuthor($blogPost);

        return $this->render('blog_post/show.html.twig', [
            'blog_post'     => $blogPost,
            'isLiked'       => $isAlreadyLiked,
            'stringPostId'  => $postId->toString(),
            'isAuthor'      => $isAuthor,
            'likeToken'     => $likeToken
        ]);
    }

    /**
     * @Route("/{slug}/admin-show", name="blog_post_admin_show", methods={"GET"})
     * IsGranted("ROLE_ADMIN")
     */
    public function adminShow(BlogPost $blogPost): Response
    {
        return $this->render('blog_post/admin/show.html.twig', [
            'blog_post' => $blogPost,
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
     * @Route("/{slug}/edit-admin", name="blog_post_admin_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function adminEdit(Request $request, BlogPost $blogPost): Response
    {
        $form = $this->createForm(AdminBlogPostType::class, $blogPost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_posts');
        }

        return $this->render('blog_post/admin/edit.html.twig', [
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
     * @Route("/{slug}/like", name="blog_post_like", methods={"POST"})
     */
    public function like(
        BlogPost $blogPost,
        BlogPostLiker $liker,
        SessionInterface $session,
        Request $request
    ): Response {
        $sessionLikeToken = $session->get('likeToken')->toString();
        $postLikeToken = $request->request->get('likeToken');

        if ($sessionLikeToken === $postLikeToken) {
            $liker->like($blogPost);
        }
        $session->remove('likeToken');
        return $this->redirectToRoute('blog_post_show', ['slug' => $blogPost->getSlug()]);
    }

    /**
     * @Route("/{slug}/unlike", name="blog_post_unlike", methods={"POST"})
     */
    public function unlike(
        BlogPost $blogPost,
        BlogPostLiker $liker,
        SessionInterface $session,
        Request $request
    ): Response {
        $sessionLikeToken = $session->get('likeToken')->toString();
        $postLikeToken = $request->request->get('likeToken');
        if ($sessionLikeToken === $postLikeToken) {
            $liker->unlike($blogPost);
        }
        $session->remove('likeToken');
        return $this->redirectToRoute('blog_post_show', ['slug' => $blogPost->getSlug()]);
    }
}
