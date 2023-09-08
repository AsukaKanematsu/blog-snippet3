<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Domain\ValueObject\User\UserId;
use App\Domain\ValueObject\Blog\BlogTitle;
use App\Domain\ValueObject\Blog\BlogContents;
use App\UseCase\UseCaseInput\CreateBlogInput;
use App\UseCase\UseCaseInteractor\CreateBlogInteractor;

session_start();
//ユーザーのidを取得する処理
$id = $_SESSION['user']['id'];
$title = filter_input(INPUT_POST, 'blog_title');
$contents = filter_input(INPUT_POST, 'contents');

try {
    if (empty($title) || empty($contents)) {
        throw new Exception('タイトルか内容を入力してください');
    }

    $userId = new UserId($id);
    $blogTitle = new BlogTitle($title);
    $blogContents = new BlogContents($contents);
    $useCaseInput = new CreateBlogInput($userId, $blogTitle, $blogContents);
    $useCase = new CreateBlogInteractor($useCaseInput);
    $useCaseOutput = $useCase->handler();

    if (!$useCaseOutput->isSuccess()) {
        throw new Exception($useCaseOutput->message());
    }
    header('Location: ../index.php');
    exit();
} catch (Exception $e) {
    $_SESSION['errors'][] = $e->getMessage();
    header('Location: ../create.php');
    exit();
}

if (empty($blogTitle) || empty($contents)) {
    $_SESSION['errors'] = 'タイトルか内容の入力がありません';
    header('Location: ../create.php');
    exit();
}

$sql =
    'INSERT INTO blogs(user_id, title, contents) VALUES(:userId, :blogTitle, :contents)';

try {
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':userId', $userId, PDO::PARAM_INT);
    $statement->bindValue(':blogTitle', $blogTitle, PDO::PARAM_STR);
    $statement->bindValue(':contents', $contents, PDO::PARAM_STR);
    $statement->execute();
    header('Location: ../mypage.php');

    exit();
} catch (PDOException $e) {
    $_SESSION['errors'][] = 'ブログ記事の登録に失敗しました。';
    header('Location: ../create.php');
    exit();
}
