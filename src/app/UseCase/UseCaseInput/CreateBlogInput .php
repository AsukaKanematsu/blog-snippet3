<?php

namespace App\UseCase\UseCaseInput;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Domain\ValueObject\User\UserId;
use App\Domain\ValueObject\BlogTitle;
use App\Domain\ValueObject\Contents;

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
     * @var Contents
     */
    private $blogContents;

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
        Contents $blogContents
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->blogContents = $blogContents;
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
     * @return Contents
     */
    public function contents(): Contents
    {
        return $this->blogContents;
    }
}
