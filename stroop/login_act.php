<?php

// 共通処理
session_start();
include("functions.php");
check_session_id();

if (
    !$_POST["username"] || $_POST["username"] == "" ||
    !$_POST["password"] || $_POST["password"] == ""
) {
    header("Location:index.php");
    exit();
}

$username = $_POST["username"];
$password = $_POST["password"];

$pdo = connect_to_db();

$sql = "SELECT * from stroop_user_table where username = :username AND password = :password";

// SQL実行時にエラーがある場合はエラーを表示して終了
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":username", $username, PDO::PARAM_STR);
$stmt->bindValue(":password", $password, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // うまくいったらデータ（1レコード）を取得
    $val = $stmt->fetch(PDO::FETCH_ASSOC);
}

// ユーザ情報が取得できない場合はメッセージを表示
if (!$val) {
    echo "<p>ログイン情報に誤りがあります。</p>";
    echo '<a href="index.php">戻る(トホホ…)</a>';
    exit();
} else {
    // ログインできたら情報をsession領域に保存して一覧ページへ移動
    $_SESSION = array(); // セッション変数を空にする
    $_SESSION["session_id"] = session_id();
    $_SESSION["user_id"] = $val["user_id"];
    header("Location:home.php");
    exit();
}
