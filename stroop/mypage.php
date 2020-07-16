<?php
// 共通処理
session_start();
include("functions.php");
check_session_id();

$user_id = $_SESSION["user_id"];
$pdo = connect_to_db();

$sql_recentdata = "SELECT * from stroop_data_table where user_id_isdata=:user_id order by id desc limit 10";

// SQL実行時にエラーがある場合はエラーを表示して終了
$stmt_recentdata = $pdo->prepare($sql_recentdata);
$stmt_recentdata->bindValue(":user_id", $user_id, PDO::PARAM_STR);
$status_recentdata = $stmt_recentdata->execute();

if ($status_recentdata == false) {
    $error = $stmt_recentdata->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    $result_recentdata = $stmt_recentdata->fetchAll(PDO::FETCH_ASSOC);
    $output = "";
    foreach ($result_recentdata as $record) {
        $output .= "<tr>";
        $output .= "<td>{$record["get_point"]}問</td>";
        $output .= "<td>{$record["get_point"]}/{$record["answer_point"]}問</td>";
        $output .= "</tr>";
    };
};

$sql_average = "SELECT * from stroop_user_table LEFT OUTER JOIN (SELECT user_id_isdata, AVG(get_point) AS average FROM stroop_data_table GROUP BY user_id_isdata) AS average ON stroop_user_table.user_id = average.user_id_isdata where user_id=:user_id";
$stmt_average = $pdo->prepare($sql_average);
$stmt_average->bindValue(":user_id", $user_id, PDO::PARAM_STR);
$status_average = $stmt_average->execute();
if ($status_average == false) {
    echo "koko";
    $error = $stmt_average->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    $average = $stmt_average->fetch(PDO::FETCH_ASSOC);
    $avg_text = "平均正答数：{$average['average']}";
};

$sql_max = "SELECT * from stroop_user_table LEFT OUTER JOIN (SELECT user_id_isdata, MAX(get_point) AS maximum FROM stroop_data_table GROUP BY user_id_isdata) AS maximum ON stroop_user_table.user_id = maximum.user_id_isdata where user_id=:user_id";
$stmt_max = $pdo->prepare($sql_max);
$stmt_max->bindValue(":user_id", $user_id, PDO::PARAM_STR);
$status_max = $stmt_max->execute();
if ($status_max == false) {
    $error = $stmt_max->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    $max = $stmt_max->fetch(PDO::FETCH_ASSOC);
    $max_text = "最大正答数：{$max['maximum']}";
};



?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel=" stylesheet" href="css/style.css">
    <title>ストループ現象</title>
</head>

<body>
    <div class="wrapper">
        <h1>My Data</h1>
        <p><?= $max_text ?></p>
        <p><?= $avg_text ?></p>
        <div id="table_div">
            <h2>最新の10件</h2>
            <table>
                <tr>
                    <th>正答数</th>
                    <th>解答数含む</th>
                </tr>
                <?= $output ?>
            </table>
        </div>
        <a href="home.php">
            <div class="btns">とじる</div>
        </a>
    </div>
</body>

</html>