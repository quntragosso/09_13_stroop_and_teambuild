<?php

// 共通処理
// session_start();
include("functions.php");
// check_session_id();

$username = "hogehoge";
// $news_id = $_get["id"];
$news_id = 1;

$sql = "SELECT * from news_table where id=:news_id";

$pdo = connect_to_db();
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":news_id", $news_id, PDO::PARAM_INT);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$title = $result[0]["title"];
$output = "記事タイトル:{$title}";
$output .= "<input type='hidden' name='news_id' value='{$news_id}'>"

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>投稿ページ</title>
</head>

<body>
    <form action="useraction_act.php" method="POST">
        <p id="title">
            <?= $output ?>
        </p>
        <div id="stars_box">
            <div id="star1_div" class="stars"><label for="star1" id="star1_label">☆</label><input type="radio" name="rating" value="1" id="star1"></div>
            <div id="star2_div" class="stars"><label for="star2" id="star2_label">☆</label><input type="radio" name="rating" value="2" id="star2"></div>
            <div id="star3_div" class="stars"><label for="star3" id="star3_label">☆</label><input type="radio" name="rating" value="3" id="star3"></div>
            <div id="star4_div" class="stars"><label for="star4" id="star4_label">☆</label><input type="radio" name="rating" value="4" id="star4"></div>
            <div id="star5_div" class="stars"><label for="star5" id="star5_label">☆</label><input type="radio" name="rating" value="5" id="star5"></div>
        </div>
        コメント:<textarea name="comment" row="50" col="10"></textarea>
        <div><button>送信する</button></div>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/system.js"></script>
</body>

</html>