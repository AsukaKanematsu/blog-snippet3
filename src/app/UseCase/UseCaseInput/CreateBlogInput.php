<?php

namespace App\UseCase\UseCaseInput;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Domain\ValueObject\User\UserId;
use App\Domain\ValueObject\Blog\BlogTitle;
use App\Domain\ValueObject\Blog\BlogContents;

/**
 * ログインユースケースの入力値
 */
final class CreateBlogInput
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

    /**
     * コンストラクタ
     *
     * @param UserId $id
     * @param BlogTitle $blog
     * @param BlogContents $contents
     */
    public function __construct(
        UserId $id,
        BlogTitle $title,
        BlogContents $contents
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->contents = $contents;
    }

    /**
     * @return UserId
     */
    public function id(): UserId
    {
        return $this->id;
    }

    /**
     * @return BlogTitle
     */
    public function title(): BlogTitle
    {
        return $this->title;
    }

    /**
     * @return BlogContents
     */
    public function contents(): BlogContents
    {
        return $this->contents;
    }
}
