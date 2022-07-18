<?php
namespace Acme\Blog\Controller;

/*
 * This file is part of the Acme.Blog package.
 */

use Acme\Blog\Domain\Repository\TagRepository;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;
use Acme\Blog\Domain\Model\Tag;

class TagController extends ActionController
{
    /**
     * @Flow\Inject
     * @var TagRepository
     */
    protected TagRepository $tagRepository;

    public function indexAction(): void
    {
        $this->view->assign('tags', $this->tagRepository->findAll());
    }

    public function showAction(Tag $tag): void
    {
        $this->view->assign('tag', $tag);
    }

    public function newAction() : void
    {
    }

    public function createAction(Tag $newTag): void
    {
        $this->tagRepository->add($newTag);
        $this->addFlashMessage('Created a new tag.');
        $this->redirect('index');
    }

    public function editAction(Tag $tag): void
    {
        $this->view->assign('tag', $tag);
    }

    public function updateAction(Tag $tag): void
    {
        $this->tagRepository->update($tag);
        $this->addFlashMessage('Updated the tag.');
        $this->redirect('index');
    }

    public function deleteAction(Tag $tag): void
    {
        $this->tagRepository->remove($tag);
        $this->addFlashMessage('Deleted a tag.');
        $this->redirect('index');
    }
}
