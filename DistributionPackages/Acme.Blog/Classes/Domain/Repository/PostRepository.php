<?php
namespace Acme\Blog\Domain\Repository;

/*                                                                        *
 * This script belongs to the Flow package "Acme.Blog".                   *
 *                                                                        *
 *                                                                        */

use Acme\Blog\Domain\Model\Blog;
use Acme\Blog\Domain\Model\Post;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\QueryInterface;
use Neos\Flow\Persistence\QueryResultInterface;
use Neos\Flow\Persistence\Repository;

/**
 * @Flow\Scope("singleton")
 */
class PostRepository extends Repository
{

    /**
     * Finds posts by the specified blog
     *
     * @param Blog $blog The blog the post must refer to
     * @return QueryResultInterface The posts
     */
    public function findByBlog(Blog $blog): QueryResultInterface
    {
        $query = $this->createQuery();
        return
            $query->matching(
                $query->equals('blog', $blog)
            )
                ->setOrderings(array('date' => QueryInterface::ORDER_DESCENDING))
                ->execute();
    }

    /**
     * Finds the previous of the given post
     *
     * @param Post $post The reference post
     * @return Post|null The previous post or null if the given $post is the first one
     */
    public function findPrevious(Post $post): ?Post
    {
        $query = $this->createQuery();
        return
            $query->matching(
                $query->logicalAnd([
                    $query->equals('blog', $post->getBlog()),
                    $query->lessThan('date', $post->getDate())
                ])
            )
                ->setOrderings(array('date' => QueryInterface::ORDER_DESCENDING))
                ->execute()
                ->getFirst();
    }

    /**
     * Finds the post next to the given post
     *
     * @param Post $post The reference post
     * @return Post|null The next post or null if the given $post is the last one
     */
    public function findNext(Post $post): ?Post
    {
        $query = $this->createQuery();
        return
            $query->matching(
                $query->logicalAnd([
                    $query->equals('blog', $post->getBlog()),
                    $query->greaterThan('date', $post->getDate())
                ])
            )
                ->setOrderings(array('date' => QueryInterface::ORDER_ASCENDING))
                ->execute()
                ->getFirst();
    }

}
