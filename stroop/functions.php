<?php

function connect_to_db()
{
  // DB接続の設定
  // DB名は`gsacf_x00_00`にする
  // // ローカル
  // $dbn = 'mysql:dbname=gsacfd06_13;charset=utf8;port=3306;host=localhost';
  // $user = 'root';
  // $pwd = '';

  // デプロイ時
  $dbn = 'mysql:dbname=6eeafbf257a670616b96c8b7ef7d47d8;charset=utf8;port=3306;host=mysql-2.mc.lolipop.lan';
  $user = '6eeafbf257a670616b96c8b7ef7d47d8';
  $pwd = 'Qunc57e8acfd7e87';

  try {
    // ここでDB接続処理を実行する
    return new PDO($dbn, $user, $pwd);
  } catch (PDOException $e) {
    // DB接続に失敗した場合はここでエラーを出力し，以降の処理を中止する
    echo json_encode(["db error" => "{$e->getMessage()}"]);
    exit();
  }
}

// ログイン状態のチェック関数
function check_session_id()
{
  if (
    !isset($_SESSION["session_id"]) ||
    $_SESSION["session_id"] != session_id()
  ) {
    header("Location:index.php");
  } else {
    session_regenerate_id(true);
    $_SESSION["session_id"] = session_id();
  }
}
