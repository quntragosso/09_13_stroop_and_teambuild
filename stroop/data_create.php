<?php
// 共通処理
session_start();
include("functions.php");
check_session_id();

$user_id = $_SESSION["user_id"];
$get_point = $_POST["get_point"];
$answer_point = $_POST["answer_point"];

$sql = "INSERT INTO stroop_data_table(id, user_id_isdata, get_point, answer_point, created_at) VALUE(NULL, :user_id, :get_point, :answer_point, sysdate())";

$pdo = connect_to_db();
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":user_id", $user_id, PDO::PARAM_STR);
$stmt->bindValue(":get_point", $get_point, PDO::PARAM_INT);
$stmt->bindValue(":answer_point", $answer_point, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    exit();
}
