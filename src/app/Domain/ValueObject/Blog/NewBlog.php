<?php

namespace App\Domain\ValueObject\Blog;
require_once __DIR__ . '/../../../../vendor/autoload.php';
use App\Domain\ValueObject\BlogTitle;
use App\Domain\ValueObject\Contents;

/**
 * 新規登録ユーザーのValueObject
 */
final class NewBlog
{
    /**
     * @var BlogTitle
     */
    private $title;

    /**
     * @var Contents
     */
    private $contents;

    public function __construct(BlogTitle $title, Contents $contents)
    {
        $this->title = $title;
        $this->contents = $contents;
    }

    public function Title(): BlogTitle
    {
        return $this->title;
    }

    public function Contents(): Contents
    {
        return $this->contents;
    }
}
