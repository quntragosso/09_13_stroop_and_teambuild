<?php
// 共通処理
session_start();
include("functions.php");

$username = $_POST["username"];
$password = $_POST["password"];

// DB接続
$pdo = connect_to_db();
// データ取得SQL作成&実行
$sql = 'SELECT * FROM kqfm_user_table WHERE user_username=:username AND user_password=:password AND user_is_deleted=0';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$status = $stmt->execute();

// SQL実行時にエラーがある場合
if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
}

// うまくいったらデータ（1レコード）を取得
$val = $stmt->fetch(PDO::FETCH_ASSOC);

// ユーザ情報が取得できない場合はメッセージを表示
if (!$val) {
    echo "<p>ログイン情報に誤りがあります．</p>";
    echo '<a href="login.php">もどる</a>';
    exit();
} else {
    $_SESSION = array();
    $_SESSION["session_id"] = session_id();
    $_SESSION["username"] = $val["user_username"];
    header("Location:mypage.php");
    exit();
}
