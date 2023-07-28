<?php
// 0. SESSION開始！！
session_start();

// 0. funcs.php を読み込む
//１．関数群の読み込み
require_once('funcs.php');
loginCheck();

//1.  DB接続します
try {
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=ej_db;charset=utf8;host=localhost', 'root', '');
} catch (PDOException $e) {
    exit('DBConnectError' . $e->getMessage());
}


//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM article_table");
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("ErrorQuery:" . $error[2]);
} else {
    //Selectデータの数だけ自動でループしてくれる
    //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // $view .= "<p>";
        // $view .= $result['date'] . ' : ' . h($result['title']) . ' | ' . h(mb_substr($result['content'],0,40).'…'); //resultの中身を表示させる
        // $view .= "</p>";


        $view .= '<tr><td>';
        $view .= '<a href="detail.php?id=' . $result['id'] . '">'. $result['date']  . '</a>' .  ' </td><td> ' . h($result['title']) . '</td><td>' . h(mb_substr($result['content'], 0, 40) . '…'); //resultの中身を表示させる
        
        $view .= "</td></tr>";
    }
}

$displayName = $_SESSION['display_name'];


?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>記事一覧</title>
    <link rel="stylesheet" href="css/range.css">
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
</head>

<body id="main">

    <!-- ヘッダー読み込み -->
    <?php include "header.html" ?>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <p>ログイン中ユーザー名：<?= $displayName ?></p>
    <div id="headline">
        <h1>マイページ</h1>
    </div>
    <div>
        <table class="fixed_headers">
            <thead>
                <tr>
                    <th>作成日時</th>
                    <th>タイトル</th>
                    <th>記事詳細</th>
                </tr>
            </thead>
            <tbody>
                <?= $view ?>
            </tbody>
        </table>
    </div>
    <!-- Main[End] -->
</body>

</html>