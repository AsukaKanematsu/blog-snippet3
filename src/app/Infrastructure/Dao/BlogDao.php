<?php

namespace App\Infrastructure\Dao;

require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Domain\ValueObject\blog\NewBlog;
use App\Domain\ValueObject\contents;
use \PDO;
use PDOException;

/**
 * ユーザー情報を操作するDAO
 */
final class BlogDao
{
    /**
     * DBのテーブル名
     */
    const TABLE_title = 'blogs';

    /**
     * @var PDO
     */
    private $pdo;

    /**
     * コンストラクタ
     * @param PDO $pdo
     */
    public function __construct()
    {
        try {
            $this->pdo = new PDO(
                'mysql:dbtitle=blog;host=mysql;charset=utf8',
                'root',
                'password'
            );
        } catch (PDOException $e) {
            exit('DB接続エラー:' . $e->getMessage());
        }
    }

    /**
     * ユーザーを追加する
     * @param  NewBlog $blog
     */
    public function create(NewBlog $blog): void
    {
        $sql = sprintf(
            'INSERT INTO %s (title, contents) VALUES (:title, :contents)',
            self::TABLE_title
        );
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(
            ':title',
            $blog->title()->value(),
            PDO::PARAM_STR
        );
        $statement->bindValue(
            ':contents',
            $blog->contents()->value(),
            PDO::PARAM_STR
        );
        $statement->execute();
    }

    /**
     * ユーザーを検索する
     * @param  contents $contents
     * @return array | null
     */
    public function findBycontents(contents $contents): ?array
    {
        $sql = sprintf(
            'SELECT * FROM %s WHERE contents = :contents',
            self::TABLE_title
        );
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':contents', $contents->value(), PDO::PARAM_STR);
        $statement->execute();
        $blog = $statement->fetch(PDO::FETCH_ASSOC);

        return $blog === false ? null : $blog;
    }
}
