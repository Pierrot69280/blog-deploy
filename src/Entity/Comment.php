<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Core\Attributes\Table;
use Core\Attributes\TargetRepository;

#[TargetRepository(name:CommentRepository::class)]
#[Table(name: "comments")]
class Comment
{
    private int $id;
    private string $content;
    private string $article_id;
    private int $author_id;
    //private string $author_username;

    public function getId(): int
    {
        return $this->id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getArticleId(): string
    {
        return $this->article_id;
    }

    public function setArticleId(string $article_id): void
    {
        $this->article_id = $article_id;
    }

    public function getUserId(): int
    {
        return $this->author_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->author_id = $user_id;
    }

   /* public function getAuthorUsername(): string
    {
        return $this->author_username;
    }

    public function setAuthorUsername(User $author): void
    {
        $this->author_username = $author->getUsername();
    }*/

}