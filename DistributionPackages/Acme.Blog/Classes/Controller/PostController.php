<?php
namespace Acme\Blog\Controller;

/*
 * This file is part of the Acme.Blog package.
 */

use Acme\Blog\Domain\Model\Blog;
use Acme\Blog\Domain\Model\Comment;
use Acme\Blog\Domain\Repository\BlogRepository;
use Acme\Blog\Domain\Repository\PostRepository;
# Annotations greyed out but is used?
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;
use Acme\Blog\Domain\Model\Post;
use Neos\Flow\Mvc\View\ViewInterface;
use function PHPUnit\Framework\throwException;

class PostController extends ActionController
{
    /**
     * @Flow\Inject
     * @var BlogRepository
     */
    protected BlogRepository $blogRepository;

    /**
     * @Flow\Inject
     * @var PostRepository
     */
    protected PostRepository $postRepository;


    protected function initializeView(ViewInterface $view): void
    {
        //echo $_GET['blog'];
        /*
        $blog = $this->blogRepository->findActive();
        $this->view->assign('blog', $blog);
        */
    }

    public function indexAction(?Blog $blog = null): void
    {
        if (is_null($blog)) {
            $blog = $this->blogRepository->findActive();
        }
        $this->view->assign('blog', $blog);
    }

    /**
     * @Flow\IgnoreValidation("$post")
     */
    public function showAction(Post $post): void
    {
        $this->view->assignMultiple([
            'post' => $post,
            'nextPost' => $this->postRepository->findNext($post),
            'previousPost' => $this->postRepository->findPrevious($post),
            'blog' => $post->getBlog()
        ]);
    }

    public function newAction(Blog $blog): void
    {
        $this->view->assign('blog', $blog);
    }

    public function createAction(Post $newPost): void
    {
        $this->postRepository->add($newPost);
        $this->addFlashMessage('Created a new post.');
        $this->redirect('index', $this->request->getControllerName(),
            $this->request->getControllerSubpackageKey(), ['blog' => $newPost->getBlog()]);
    }

    public function editAction(Post $post): void
    {
        $this->view->assign('post', $post);
    }

    public function updateAction(Post $post): void
    {
        $this->postRepository->update($post);
        $this->addFlashMessage('Updated the post.');
        $this->redirect('index');
    }

    public function deleteAction(Post $post): void
    {
        $this->postRepository->remove($post);
        $this->addFlashMessage("Deleted the post \"{$post->getSubject()}\".");
        $this->redirect('index');
    }

}
