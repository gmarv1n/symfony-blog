<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\PostServices\CommentsCountManager;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use DateTime;
use App\Entity\BlogPost;
use App\Service\PostServices\PostFinder;

/**
 * @Route("/comment")
 */
class CommentController extends AbstractController
{
    /**
     * @Route("/", name="comment_index", methods={"GET"})
     */
    public function index(CommentRepository $commentRepository): Response
    {
        return $this->render('comment/index.html.twig', [
            'comments' => $commentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/by_post", name="comment_index_for_post", methods={"GET"})
     * This method might determ what is the id of post and return all of comments for it
     */
    public function showPostsComments(BlogPost $post, CommentRepository $commentRepository): Response
    {
        return $this->render('comment/_comment_list_in_post.html.twig', [
            'comments' => $commentRepository->findCommentsByPost($post),
            'post'   => $post,
        ]);
    }

    /**
     * @Route("/new/{postId}", name="comment_new", methods={"GET","POST"})
     */
    public function new(
        Request $request,
        CommentsCountManager $commentsCountManager,
        PostFinder $postFinder,
        string $postId
    ): Response {
        /** @var \App\Entity\Comment $comment */
        $comment = new Comment();

        $post = $postFinder->getPostById($postId);
        
        $postSlug = $post->getSlug();
        // $form = $this->createForm(CommentType::class, $comment);

        $todayDate = new DateTime("NOW");

        $userId = $this->getUser()->getId();

        $form = $this->createFormBuilder($comment)
                     ->add('author_id', TextType::class, [
                        'data' => $userId,
                         ])
                     ->add('post_id', TextType::class, [
                        'data' => $postId,
                         ])
                     ->add('comment')
                     ->add('is_approved')
                     ->add('date', DateTimeType::class, [
                        'data' => $todayDate,
                         ])
                     ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();

            $commentsCountManager->increment($post);

            return $this->redirectToRoute('blog_post_show', ['slug' => $postSlug]);
        }

        return $this->render('comment/new.html.twig', [
            'comment' => $comment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="comment_show", methods={"GET"})
     */
    public function show(Comment $comment): Response
    {
        return $this->render('comment/show.html.twig', [
            'comment' => $comment,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="comment_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Comment $comment): Response
    {
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('comment_index');
        }

        return $this->render('comment/edit.html.twig', [
            'comment' => $comment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="comment_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Comment $comment): Response
    {
        if ($this->isCsrfTokenValid('delete'.$comment->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($comment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('comment_index');
    }
}
