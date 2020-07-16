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
    <link rel=" stylesheet" href="css/style.css">
    <title>ストループ現象</title>
</head>

<body>
    <div class="wrapper">
        <h1>Stroop Test</h1>
        <div id="divs_box">
            <div id="first_div" class="divs">
                <div id="register_btn" class="btns">new account</div>
                <div id="login_btn" class="btns">login</div>
            </div>
            <div id="register_div" class="divs">
                <form action="register_act.php" method="POST">
                    <div>username<input type="text" name="username" maxlength="12"></div>
                    <div>password<input type="text" name="password" maxlength="8"></div>
                    <div><button>go</button></div>
                </form>
            </div>
            <div id="login_div" class="divs">
                <form action="login_act.php" method="POST">
                    <div>username<input type="text" name="username" maxlength="12"></div>
                    <div>password<input type="text" name="password" maxlength="8"></div>
                    <div><button>go</button></div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
    </script>
    <script type="text/javascript" src="js/system.js"></script>
</body>

</html>