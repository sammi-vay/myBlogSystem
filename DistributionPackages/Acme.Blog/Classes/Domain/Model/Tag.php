<?php
namespace Acme\Blog\Domain\Model;

/*
 * This file is part of the Acme.Blog package.
 */

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Neos\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class Tag
{
    /**
     * @ORM\ManyToMany(mappedBy="tags")
     * @var Collection<Post>
     */
    protected Collection $posts;

    /**
     * @var string
     */
    protected string $name;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getPosts(): ArrayCollection|Collection
    {
        return $this->posts;
    }
}
