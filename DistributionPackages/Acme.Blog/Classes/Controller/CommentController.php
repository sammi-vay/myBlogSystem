<?php
namespace Acme\Blog\Controller;

/*
 * This file is part of the Acme.Blog package.
 */

use Acme\Blog\Domain\Model\Post;
use Acme\Blog\Domain\Repository\CommentRepository;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;
use Acme\Blog\Domain\Model\Comment;
use Neos\Flow\Mvc\View\ViewInterface;

class CommentController extends ActionController
{


    /**
     * @Flow\Inject
     * @var CommentRepository
     */
    protected CommentRepository $commentRepository;

    public function initializeView(ViewInterface $view): void
    {

    }

    public function indexAction(): void
    {
        $this->view->assign('comments', $this->commentRepository->findAll());
    }

    public function showAction(Comment $comment): void
    {
        $this->view->assign('comment', $comment);
    }

    public function newAction(Post $post): void
    {
        $this->view->assign('post', $post);
    }

    public function createAction(Comment $newComment): void
    {
        $this->commentRepository->add($newComment);
        $this->addFlashMessage('Created a new comment.');
        $this->redirect('show', 'post',
            $this->request->getControllerSubpackageKey(), ['post' => $newComment->getPost()]);
    }

    public function editAction(Post $post, Comment $comment): void
    {
        $this->view->assignMultiple([
            'post' => $post,
            'comment' => $comment,
            'blog' => $post->getBlog()
        ]);
    }

    public function updateAction(Post $post, Comment $comment): void
    {
        $this->commentRepository->update($comment);
        $this->addFlashMessage('Updated the comment.');
        #$this->redirect('index');
        $this->redirect('show', "post", null, ["post" => $post]);
    }

    public function deleteAction(Comment $comment): void
    {
        # not needed but checks if parameters are empty
        if (empty($comment)) {
            die('no comment submitted');
        }

        $this->commentRepository->remove($comment);
        $this->addFlashMessage('Deleted a comment.');
        $this->redirect('index');
    }
}
