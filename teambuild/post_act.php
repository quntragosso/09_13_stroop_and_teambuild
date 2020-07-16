<?php

// 共通処理
// session_start();
include("functions.php");
// check_session_id();

// ログインページからセッションで引き継ぐ想定のため、今回は個別指定。
$username = "hogehoge";

$title = $_POST["title"];
$url = $_POST["url"];
$category = $_POST["category"];
$comment = $_POST["comment"];

$sql = "INSERT INTO kqfm_news_table(news_id, news_title, news_category, news_url, news_username, news_comment, news_created_at, news_updated_at, news_is_deleted) VALUE(NULL, :title, :category, :url, :username, :comment, sysdate(), sysdate(), 0)";

$pdo = connect_to_db();
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":title", $title, PDO::PARAM_STR);
$stmt->bindValue(":category", $category, PDO::PARAM_STR);
$stmt->bindValue(":url", $url, PDO::PARAM_STR);
$stmt->bindValue(":username", $username, PDO::PARAM_STR);
$stmt->bindValue(":comment", $comment, PDO::PARAM_STR);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は一覧ページファイルに移動し，一覧ページの処理を実行する
    header("Location:mypage.php");
    exit();
}
