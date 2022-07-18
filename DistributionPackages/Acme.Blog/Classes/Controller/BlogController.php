<?php
namespace Acme\Blog\Controller;

/*
 * This file is part of the Acme.Blog package.
 */

use Acme\Blog\Domain\Repository\BlogRepository;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;
use Acme\Blog\Domain\Model\Blog;

class BlogController extends ActionController
{
    /**
     * @Flow\Inject
     * @var BlogRepository
     */
    protected BlogRepository $blogRepository;

    public function indexAction(): void
    {
        $this->view->assign('blogs', $this->blogRepository->findAll());
    }

    public function showAction(?Blog $blog): void
    {
        if (is_null($blog)) {
            $blog = $this->blogRepository->findActive();
        }
        $this->view->assign('blog', $blog);
    }

    public function selectBlogAction(Blog $blog): void
    {
        $this->view->assign('blog', $blog);
        $this->redirect('index', "post", null, ['blog' => $blog]);
    }

    public function newAction(): void
    {
    }

    public function createAction(Blog $newBlog): void
    {
        $this->blogRepository->add($newBlog);
        $this->addFlashMessage('Created a new blog.');
        $this->redirect('index');
    }

    public function editAction(Blog $blog): void
    {
        $this->view->assign('blog', $blog);
    }

    public function updateAction(Blog $blog): void
    {
        $this->blogRepository->update($blog);
        $this->addFlashMessage('Updated the blog.');
        $this->redirect('index');
    }

    public function deleteAction(Blog $blog): void
    {
        $this->blogRepository->remove($blog);
        $this->addFlashMessage('Deleted a blog.');
        $this->redirect('index');
    }
}
