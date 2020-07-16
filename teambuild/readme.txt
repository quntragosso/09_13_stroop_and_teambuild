teambuildはチーム開発体験です。
メンバーは11:北島さん, 29:藤井さん, 34:森さん。
newsSNSみたいなのを目指しました。

sqlはkqfm_で始まる4件です。
functions.phpはdb接続とsessionチェック。

①トップページ→森さん
②ログインページ→藤井さん
③マイページ→北島さん
④投稿機能, なんかいろいろphp, 全体の移植作業→わたし
みたいな感じです。

なのでcss調整とか変数調整とかところどころ手を加えていて、、、見ていただく側としてあれです。

①トップページ関連
index.php

②ログインページ関連
もととなるデザインが藤井さん作であり、それをもとにわたしがlogin.php, register.php, login_act.php, register_act.phpを作成

③マイページ関連
mypage.phpがそれです。

④その他
mypage.php内に投稿actionがあり, これはpost_act.phpと合わせてわたし作。またまだ移植できていませんが, useraction.php, useraction_act.phpで他のページにコメントしたり評価したりできるパーツもわたしが作りました。jsが地味にあり★の数でvalue値を送れるちっちゃい機能作ってます。

cssの中身がまだ全体突っ込んでてごちゃごちゃです…。