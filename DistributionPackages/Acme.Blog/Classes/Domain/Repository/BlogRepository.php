<?php
namespace Acme\Blog\Domain\Repository;

/*                                                                        *
 * This script belongs to the Flow package "Acme.Blog".                   *
 *                                                                        *
 *                                                                        */

use Acme\Blog\Domain\Model\Blog;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\Repository;

/**
 * @Flow\Scope("singleton")
 */
class BlogRepository extends Repository
{
    /**
     * Finds the active blog.
     */
    public function findActive(): ?Blog
    {
        $query = $this->createQuery();
        return $query->execute()->getFirst();
        # execute returns a queryinterface impl. \Countable, \Iterator, \ArrayAccess
    }

}
