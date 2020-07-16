<?php
// 共通処理
session_start();
include("functions.php");
check_session_id();

$user_id = $_SESSION["user_id"];
$pdo = connect_to_db();

$sql = "SELECT * from stroop_user_table where user_id = :user_id";

// SQL実行時にエラーがある場合はエラーを表示して終了
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":user_id", $user_id, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // うまくいったらデータ（1レコード）を取得
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
};

$hello = "こんにちは　{$result['username']}　さん！";

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
        <h1>Stroop Test</h1>
        <p><?= $hello ?></p>
        <div id="divs_box">
            <div id="first_div" class="divs">
                <div class="half_div">
                    <a href="game.php">
                        <div id="play_btn" class="btns">play</div>
                    </a>
                    <a href="mypage.php">
                        <div id="mypage_btn" class="btns">my data</div>
                    </a>
                </div>
                <div class="half_div">
                    <div id="how_btn" class="btns">how play?</div>
                    <a href="ranking.php">
                        <div id="ranking_btn" class="btns">ranking</div>
                    </a>
                </div>
            </div>
            <div id="how_div" class="divs">
                <p>ストループ効果とは, <br>文字が示す色名と, <br>文字に着色された色名とが異なる場合に, <br>それらが互いに干渉しあうことで, <br>文字に着色された色名を答えることが<br>困難になるという現象のことを指します。<br>ちなみに関係が逆になるものは, <br>逆ストループ効果と呼ばれます。<br>このゲームは, <br>そのストループ効果を体感して, <br>また繰り返し行うことで, <br>脳トレでもしてみようみたいなゲームです。<br>　<br>着色された色名を答えるのか, <br>書かれた色名を答えるのかは表示されるので, <br>適切なボタンをタップしてください。</p>
            </div>
        </div>
        <div id="close_btn" class="btns">とじる</div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
    </script>
    <script type="text/javascript" src="js/system.js"></script>
</body>

</html>