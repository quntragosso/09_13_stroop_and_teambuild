<?php

// 共通処理
// session_start();
include("functions.php");
// check_session_id();

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投稿ページ</title>
</head>

<body>
    <form action="post_act.php" method="POST">
        記事タイトル:<input type="text" name="title"><br>
        記事URL:<input type="text" name="url"><br>
        A:<input type="radio" name="category" value="a">
        B:<input type="radio" name="category" value="b">
        C:<input type="radio" name="category" value="c">
        D:<input type="radio" name="category" value="d">
        E:<input type="radio" name="category" value="e"><br>
        コメント:<textarea name="comment" row="50" col="10"></textarea>
        <div><button>送信する</button></div>
    </form>
</body>

</html>