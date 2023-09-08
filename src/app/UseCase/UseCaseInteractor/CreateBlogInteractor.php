<?php

namespace App\UseCase\UseCaseInteractor;

use App\Domain\ValueObject\User\UserId;
use App\Domain\ValueObject\BlogTitle;
use App\Domain\ValueObject\BlogContents;
use App\UseCase\UseCaseInput\CreateBlogInput;
use App\UseCase\UseCaseOutput\CreateBlogOutput;
use App\Adapter\Repository\BlogRepository;
use App\Domain\ValueObject\Blog\NewBlog;
use App\Domain\ValueObject\User\Blogname;
use App\Domain\Entity\User;
/**
 * ユーザー登録ユースケース
 */
final class CreateBlogInteractor
{
    /**
     * メールアドレスがすでに存在している場合のエラーメッセージ
     */
    const ALLREADY_EXISTS_MESSAGE = 'すでに登録済みのメールアドレスです';

    /**
     * ユーザー登録成功時のメッセージ
     */
    const COMPLETED_MESSAGE = '登録が完了しました';

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var CreateBlogInput
     */
    private $input;

    /**
     * コンストラクタ
     *
     * @param CreateBlogInput $input
     */
    public function __construct(CreateBlogInput $input)
    {
        $this->userRepository = new BlogRepository();
        $this->input = $input;
    }

    /**
     * ユーザー登録処理
     * すでに存在するメールアドレスの場合はエラーとする
     *
     * @return CreateBlogOutput
     */
    public function handler(): CreateBlogOutput
    {
        $this->userRepository->insert(
            new NewBlog(
                $this->input->id(),
                $this->input->Title(),
                $this->input->Contents()
            )
        );
        return new CreateBlogOutput(true, self::COMPLETED_MESSAGE);
    }
}
