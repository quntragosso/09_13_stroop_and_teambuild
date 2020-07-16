<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>なんちゃらニュースマガジン</title>
    <link href="https://fonts.googleapis.com/earlyaccess/nicomoji.css" rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div id="wrap">
        <div id="head">
            <h1>なんちゃらとうろくページ</h1>
        </div>
        <div id="content">
            <div id="lead">
                <p>お名前とパスワードを記入してログインしてください。</p>
                <p>既に登録済の方はこちらからどうぞ。</p>
                <p>&raquo;<a href="login.php">ログインする</a></p>
            </div>
            <form action="register_act.php" method="post">
                <dl>
                    <dt>お名前</dt>
                    <dd>
                        <input type="text" name="username" size="28" maxlength="24">
                    </dd>
                    <dt>パスワード</dt>
                    <dd>
                        <input type="password" name="password" size="28" maxlength="12">
                    </dd>
                </dl>
                <div><input type="submit" value="登録する"></div>
            </form>
        </div>

    </div>
</body>

</html>