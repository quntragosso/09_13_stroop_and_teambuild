<?php

// 共通処理
// session_start();
include("functions.php");
// check_session_id();

// ログインページからセッションで引き継ぐ想定のため、今回は個別指定。
$username = "hogehoge";

$news_id = $_POST["news_id"];
$rating = $_POST["rating"];
$comment = $_POST["comment"];


$sql = "INSERT INTO useraction_table(id, news_id, username, rating, action_comment, created_at) VALUE(NULL, :news_id, :username, :rating, :action_comment, sysdate())";

$pdo = connect_to_db();
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":news_id", $news_id, PDO::PARAM_INT);
$stmt->bindValue(":username", $username, PDO::PARAM_STR);
$stmt->bindValue(":rating", $rating, PDO::PARAM_INT);
$stmt->bindValue(":action_comment", $comment, PDO::PARAM_STR);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は一覧ページファイルに移動し，一覧ページの処理を実行する
    header("Location:useraction.php");
    exit();
}
