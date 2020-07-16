<?php

// 共通処理
session_start();
include("functions.php");

if (
    !isset($_POST["username"]) || $_POST["username"] == "" ||
    !isset($_POST["password"]) || $_POST["password"] == ""
) {
    header("Location:index.php");
    exit();
}

$username = $_POST["username"];
$password = $_POST["password"];

// 同名ユーザー検索
$pdo = connect_to_db();

// ユーザ存在有無確認
$sql_search = "SELECT COUNT(*) FROM stroop_user_table WHERE username=:username";

$stmt_search = $pdo->prepare($sql_search);
$stmt_search->bindValue(":username", $username, PDO::PARAM_STR);
$status_search = $stmt_search->execute();

if ($status_search == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt_search->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
}

if ($stmt_search->fetchColumn() > 0) {
    // user_nameが1件以上該当した場合はエラーを表示して元のページに戻る
    echo "<p>このユーザー名は既に登録されているか、使用できません。</p>";
    echo '<a href="index.php">戻る(トホホ…)</a>';
    exit();
} else {
}

// 登録処理
$user_id = "";
$a = rand(1, 9);
$b = rand(0, 9);
$c = rand(0, 9);
$d = rand(0, 9);
$e = rand(0, 9);
$f = rand(0, 9);
$g = rand(0, 9);
$h = rand(0, 9);
$newArray = [$a, $b, $c, $d, $e, $f, $g, $h];
for ($i = 0; $i < count($newArray); $i++) {
    $user_id .= (string) $newArray[$i];
};

$sql_create = "INSERT INTO stroop_user_table(id, username, password, user_id) VALUE(NULL, :username, :password, :user_id)";
$stmt_create = $pdo->prepare($sql_create);
$stmt_create->bindValue(":username", $username, PDO::PARAM_STR);
$stmt_create->bindValue(":password", $password, PDO::PARAM_STR);
$stmt_create->bindValue(":user_id", $user_id, PDO::PARAM_STR);
$status_search = $stmt_create->execute();

if ($status_search == false) {
    $error = $stmt_create->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    $_SESSION = array(); // セッション変数を空にする
    $_SESSION["session_id"] = session_id();
    $_SESSION["user_id"] = $user_id;
    header("Location:home.php");
    exit();
}
