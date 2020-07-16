<?php
// 共通処理
session_start();
include("functions.php");
check_session_id();

$pdo = connect_to_db();

$sql = "SELECT * from stroop_data_table LEFT OUTER JOIN stroop_user_table ON stroop_data_table.user_id_isdata = stroop_user_table.user_id order by get_point desc limit 10";

// SQL実行時にエラーがある場合はエラーを表示して終了
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $output = "";
    foreach ($result as $record) {
        $output .= "<tr>";
        $output .= "<td>{$record["get_point"]}問</td>";
        $output .= "<td>{$record["get_point"]}/{$record["answer_point"]}問</td>";
        $output .= "<td>{$record["username"]}</td>";
        $output .= "</tr>";
    };
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
        <h1>Ranking</h1>
        <div id="table_div">
            <table>
                <tr>
                    <th>正答数</th>
                    <th>解答数含む</th>
                    <th>ユーザー名</th>
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