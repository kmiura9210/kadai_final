<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="css/main.css" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
    <title>新規ユーザー登録</title>
</head>

<body>

    <header>
        <nav class="navbar navbar-default">ユーザー登録</nav>
    </header>
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="login.php">ログイン</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- lLOGINogin_act.php は認証処理用のPHPです。 -->
    <form name="form1" action="signup_act.php" method="post">
        ID:<input type="text" name="login_id" required/><br>
        パスワード:<input type="password" name="login_pw" id='pw1'required/><br>
        表示名：<input type="text" name="display_name" required/><br>
        <!-- パスワード（確認）:<input type="password" name="login_pw_check" id='pw2' required/> -->
        <input type="submit" value="ユーザー登録" />
    </form>
    <script>
        let pw1 = document.getElementById('pw1');
        let pw2 = document.getElementById('pw2');
        
        
      
    </script>

</body>
</html>