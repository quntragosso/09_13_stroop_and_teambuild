<?php

session_start();
include("functions.php");
//login_actのセッション変数のところの名前と合わせる
$username = $_SESSION["username"];
$username = "hogehoge";

$pdo = connect_to_db();

// データベースにデータがあるか
$sql = 'SELECT * FROM kqfm_news_table WHERE news_username=:username AND news_is_deleted=0';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
    $error = $stmt->errorInfo();
    exit('sqlError:' . $error[2]);
} else {
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);
    $output = "";

    foreach ($result as $record) {
        $output .= "<tr>";
        $output .= "<td class='icon bird'>{$record["news_title"]}</td>";
        $output .= "<td>{$record["news_url"]}</td>";
        $output .= "<td>{$record["news_category"]}</td>";
        // edit deleteリンクを追加
        // $output .= "<td><a href='like_create.php?user_id={$user_id}&todo_id={$record["id"]}'>like{$record["cnt"]}</a></td>";
        // $output .= "<td><a href='todo_edit.php?id={$record["id"]}'>edit</a></td>";
        // $output .= "<td><a href='todo_delete.php?id={$record["id"]}'>delete</a></td>";
        $output .= "<td>いいね数</td>";
        $output .= "<td>シェア</td";
        $output .= "</tr>";
        // var_dump($output);
        // exit();
    }
    unset($value);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Mypage</title>
</head>

<body>
    <main>
        <div class="logout-b">
            <a href="logout.php" class="bt-samp12">
                <i class="fa fa-chevron-circle-right"></i> Logout
            </a>
        </div>
        <div class="cp_tab">
            <input type="radio" name="cp_tab" id="tab1_1" aria-controls="first_tab01" checked>
            <label for="tab1_1">Post</label>
            <input type="radio" name="cp_tab" id="tab1_2" aria-controls="second_tab01">
            <label for="tab1_2">Favorite</label>
            <input type="radio" name="cp_tab" id="tab1_3" aria-controls="third_tab01">
            <label for="tab1_3">投稿action</label>
            <div class="cp_tabpanels">
                <div id="first_tab01" class="cp_tabpanel">
                    <h2>Post</h2>
                    <p>～私の投稿記事～</p>
                    <table>
                        <tr>
                            <th>Title</th>
                            <th>URL</th>
                            <th>Category</th>
                            <th>いいね数</th>
                            <th>シェア</th>
                        </tr>
                        <?= $output ?>
                    </table>
                </div>
                <!-- <div id="first_tab02" class="cp_tabpanel">
              <h2>Favorite</h2>
              <p>～私のお気に入り記事～</p> -->
                <div id="second_tab01" class="cp_tabpanel">
                    <h2>Favorite</h2>
                    <p>～私のお気に入り記事～</p>
                    <table>
                        <tr>
                            <th>Title</th>
                            <th>URL</th>
                            <th>Category</th>
                            <th>いいね数</th>
                            <th>シェア</th>
                        </tr>
                        <tr>
                            <td class="icon bird">トリさん</td>
                            <td>空を飛ぶこと</td>
                            <td>グリーン</td>
                            <td>山</td>
                            <td>aiueo</td>
                        </tr>
                        <tr>
                            <td class="icon whale">クジラさん</td>
                            <td>潮を吹くこと</td>
                            <td>ブルー</td>
                            <td>海</td>
                            <td>aiueo</td>
                        </tr>
                        <tr>
                            <td class="icon crab">カニさん</td>
                            <td>反復横飛び</td>
                            <td>レッド</td>
                            <td>川</td>
                            <td>aiueo</td>
                        </tr>
                        <tr>
                            <td class="icon crab">カニさん</td>
                            <td>反復横飛び</td>
                            <td>レッド</td>
                            <td>川</td>
                            <td>aiueo</td>
                        </tr>
                        <tr>
                            <td class="icon crab">カニさん</td>
                            <td>反復横飛び</td>
                            <td>レッド</td>
                            <td>川</td>
                            <td>aiueo</td>
                        </tr>
                    </table>
                </div>
                <div id="third_tab01" class="cp_tabpanel">
                    <h2>投稿action</h2>
                    <p>～記事をシェアする～</p>
                    <form action="post_act.php" method="POST">
                        <table>
                            <tr>
                                <th>記事タイトル</th>
                                <td><input type="text" name="title"></td>
                            </tr>
                            <tr>
                                <th>記事URL</th>
                                <td><input type="text" name="url"></td>
                            </tr>
                            <tr>
                                <th>category</th>
                                <td>A:<input type="radio" name="category" value="a">
                                    B:<input type="radio" name="category" value="b">
                                    C:<input type="radio" name="category" value="c">
                                    D:<input type="radio" name="category" value="d">
                                    E:<input type="radio" name="category" value="e"></td>
                            </tr>
                            <tr>
                                <th>コメント</th>
                                <td><textarea name="comment"></textarea></td>
                            </tr>
                            <tr>
                                <th></th>
                                <td><button>投稿する</button></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>