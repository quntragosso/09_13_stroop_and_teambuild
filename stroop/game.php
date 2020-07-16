<?php
// 共通処理
session_start();
include("functions.php");
check_session_id();

$user_id = $_SESSION["user_id"];


$which = rand(1, 2);
$ruletext = "";
if ($which == 1) {
    $ruletext = "『文字が示す色名』を答えてください。";
} else if ($which == 2) {
    $ruletext = "文字が『何色で書かれているか』<br>答えてください。";
}
$json_which = json_encode($which, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);

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
        <div><?= $ruletext ?></div>
        <div id="display"></div>
        <div id="colorbtn_box">
            <div id="red" class="color_btns red1 red2"></div>
            <div id="blue" class="color_btns blue1 blue2"></div>
            <div id="green" class="color_btns green1 green2"></div>
            <div id="yellow" class="color_btns yellow1 yellow2"></div>
            <div id="return_btn" class="btns">もどる</div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
    </script>
    <script>
        const which = JSON.parse('<?php echo $json_which; ?>');
    </script>
    <script type="text/javascript" src="js/gamesystem.js"></script>
</body>

</html>