<?php
namespace Acme\Blog\Domain\Model;

/*
 * This file is part of the Acme.Blog package.
 */

use DateTime;
use Neos\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class Comment
{
    /**
     * @Flow\Validate(type="NotEmpty")
     * @ORM\ManyToOne(inversedBy="comments")
     * @var Post
     */
    protected Post $post;

    /**
     * @var DateTime
     */
    protected DateTime $date;

    /**
     * @var string
     */
    protected string $author;

    /**
     * @var string
     */
    protected string $emailAddress;

    /**
     * @var string
     */
    protected string $content;

    public function __construct(
        Post $post
    )
    {
        $this->post = $post;
        $this->setDate(new DateTime());
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(Post $post): void
    {
        $this->post = $post;
        $this->post->addComment($this);
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function setDate(DateTime $date): void
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

    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

    public function setEmailAddress(string $emailAddress): void
    {
        $this->emailAddress = $emailAddress;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }
}
