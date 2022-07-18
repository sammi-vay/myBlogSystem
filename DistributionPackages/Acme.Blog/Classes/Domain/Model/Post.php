<?php
namespace Acme\Blog\Domain\Model;

/*                                                                        *
 * This script belongs to the Flow package "Acme.Blog".                   *
 *                                                                        *
 *                                                                        */

use Neos\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Flow\Entity
 */
class Post {

    /**
     * @Flow\Validate(type="NotEmpty")
     * @ORM\ManyToOne(inversedBy="posts")
     * @var Blog
     */
    protected Blog $blog;

    /**
     * @Flow\Validate(type="NotEmpty")
     * @var string
     */
    protected string $subject;

    /**
     * @var \DateTime
     */
    protected \DateTime $date;

    /**
     * @Flow\Validate(type="NotEmpty")
     * @var string
     */
    protected string $author;

    /**
     * @Flow\Validate(type="NotEmpty")
     * @ORM\Column(type="text")
     * @var string
     */
    protected string $content;

    /**
     * @ORM\OneToMany(mappedBy="post")
     * @var Collection<Comment>
     */
    protected Collection $comments;

     #* @ORM\JoinTable(inverseJoinColumns={@ORM\JoinColumn(unique=true, onDelete="CASCADE")})
    /**
     * @ORM\ManyToMany(mappedBy="posts")
     * @var Collection<Tag>
     */
    protected Collection $tags;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->date = new \DateTime();
    }

    public function getBlog(): ?Blog
    {
        return $this->blog;
    }

    public function setBlog(Blog $blog): void
    {
        $this->blog = $blog;
        $this->blog->addPost($this);
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): void
    {
        $this->date = $date;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getComments(): ?Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): void
    {
        $this->comments->add($comment);
    }

    public function deleteComment(Comment $comment): void
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get all Tags from the tags Collection
     */
    public function getTags(): ?Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): void
    {
        $this->tags->add($tag);
    }

    /**
     * TODO: Get all Posts
     */

    /**
     * TODO: Check if user is admin & delete
     */
    public function deleteTag(Tag $tag): void
    {
    }

    public function removeTag(Tag $tag): void
    {
        $this->tags->remove($tag);
    }

    # TODO: find all posts with the specified Tag
}
