<?php
namespace Acme\Blog\Domain\Model;

/*                                                                        *
 * This script belongs to the Flow package "Acme.Blog".                   *
 *                                                                        *
 *                                                                        */

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Neos\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * A blog that contains a list of posts
 *
 * @Flow\Entity
 */
class Blog {

    /**
     * @Flow\Validate(type="NotEmpty")
     * @Flow\Validate(type="StringLength", options={ "minimum"=3, "maximum"=80 })
     * @ORM\Column(length=80)
     * @var string
     */
    protected string $title;

    /**
     * @Flow\Validate(type="StringLength", options={ "maximum"=150 })
     * @ORM\Column(length=150)
     * @var string
     */
    protected string $description = '';

    /**
     * The posts contained in this blog
     *
     * @ORM\OneToMany(mappedBy="blog")
     * @ORM\OrderBy({"date" = "DESC"})
     * @var Collection<Post>
     */
    protected Collection $posts;

    public function __construct(string $title)
    {
        $this->posts = new ArrayCollection();
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function getPosts(): Collection
    {
        return $this->posts;
    }

    /**
     * Adds a post to this blog
     */
    public function addPost(Post $post): void
    {
        $this->posts->add($post);
    }

    /**
     * Removes a post from this blog
     */
    public function removePost(Post $post): void
    {
        $this->posts->removeElement($post);
    }

}
