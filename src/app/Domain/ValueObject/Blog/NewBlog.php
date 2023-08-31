<?php

namespace App\Domain\ValueObject\Blog;
require_once __DIR__ . '/../../../../vendor/autoload.php';
use App\Domain\ValueObject\Blog\BlogTitle;
use App\Domain\ValueObject\Blog\BlogContents;
use App\Domain\ValueObject\User\UserId;

/**
 * 新規登録ユーザーのValueObject
 */
final class NewBlog
{
    /**
     * @var UserId
     */
    private $id;

    /**
     * @var BlogTitle
     */
    private $title;

    /**
     * @var BlogContents
     */
    private $contents;

    public function __construct(
        UserId $id,
        BlogTitle $title,
        BlogContents $contents
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->contents = $contents;
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function Title(): BlogTitle
    {
        return $this->title;
    }

    public function Contents(): BlogContents
    {
        return $this->contents;
    }
}
