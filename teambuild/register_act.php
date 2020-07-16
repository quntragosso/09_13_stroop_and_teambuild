<?php

// 共通処理
session_start();
include("functions.php");

// データ受け取り
$username = $_POST["username"];
$password = $_POST["password"];

// DB接続関数
$pdo = connect_to_db();

// ユーザ存在有無確認
$sql = 'SELECT COUNT(*) FROM kqfm_user_table WHERE user_username=:username';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
}

if ($stmt->fetchColumn() > 0) {
    echo "<p>すでに登録されているユーザです．</p>";
    echo '<a href="login.php">戻る</a>';
    exit();
}

// ユーザ登録SQL作成
$sql = 'INSERT INTO kqfm_user_table(user_id, user_username, user_password, user_is_deleted, user_created_at) VALUES(NULL, :username, :password, 0, sysdate())';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
    $_SESSION = array();
    $_SESSION["session_id"] = session_id();
    $_SESSION["username"] = $val["user_username"];
    header("Location:mypage.php");
    exit();
}
