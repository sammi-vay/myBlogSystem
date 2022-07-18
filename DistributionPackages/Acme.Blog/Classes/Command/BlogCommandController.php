<?php
namespace Acme\Blog\Command;

/*                                                                        *
 * This script belongs to the Flow package "Acme.Blog".                   *
 *                                                                        *
 *                                                                        */

use Acme\Blog\Domain\Model\Blog;
use Acme\Blog\Domain\Model\Post;
use Acme\Blog\Domain\Repository\BlogRepository;
use Acme\Blog\Domain\Repository\PostRepository;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Cli\CommandController;

class BlogCommandController extends CommandController
{

    /**
     * @Flow\Inject
     * @var BlogRepository
     */
    protected $blogRepository;

    /**
     * @Flow\Inject
     * @var PostRepository
     */
    protected $postRepository;

    /**
     * A command to setup a blog
     *
     * With this command you can kickstart a new blog.
     *
     * @param string $blogTitle the name of the blog to create
     * @param bool $reset set this flag to remove all previously created blogs and posts
     */
    public function setupCommand(string $blogTitle, bool $reset = false): void
    {
        if ($reset) {
            $this->blogRepository->removeAll();
            $this->postRepository->removeAll();
        }

        $blog = new Blog($blogTitle);
        $blog->setDescription('A blog about Foo, Bar and Baz.');
        $this->blogRepository->add($blog);

        $post = new Post();
        $post->setBlog($blog);
        $post->setAuthor('John Doe');
        $post->setSubject('Example Post');
        $post->setContent('Lorem ipsum dolor sit amet, consectetur adipisicing elit.' . chr(10) . 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.');
        $this->postRepository->add($post);

        $this->outputLine('Successfully created a blog "%s"', [$blogTitle]);
    }

}
