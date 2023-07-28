<?php

/**
 * 1. index.phpのフォームの部分がおかしいので、ここを書き換えて、
 * insert.phpにPOSTでデータが飛ぶようにしてください。
 * 2. insert.phpで値を受け取ってください。
 * 3. 受け取ったデータをバインド変数に与えてください。
 * 4. index.phpフォームに書き込み、送信を行ってみて、実際にPhpMyAdminを確認してみてください！ 
 */

// 0. SESSION開始！！
session_start();

// 0. funcs.php を読み込む
//１．関数群の読み込み
require_once('funcs.php');
loginCheck();


//1. POSTデータ取得
$title = $_POST['title'];
$content = $_POST['content'];

// セッションから取得
$userID = $_SESSION['user_number'];

//2. DB接続します
try {
  //ID:'root', Password: xamppは 空白 ''
  $pdo = new PDO('mysql:dbname=ej_db;charset=utf8;host=localhost', 'root', '');
} catch (PDOException $e) {
  exit('DBConnectError:' . $e->getMessage());
}

//３．データ登録SQL作成


// 1. SQL文を用意
$stmt = $pdo->prepare("INSERT INTO 
article_table(
  id, author_id, title, content, date, status
  ) VALUES (
    NULL,$userID,:title,:content,sysdate(),1
    )");

//  2. バインド変数を用意
// Integer 数値の場合 PDO::PARAM_INT
// String文字列の場合 PDO::PARAM_STR
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':content', $content, PDO::PARAM_STR);
// $stmt->bindValue(':content', $content, PDO::PARAM_STR);

//  3. 実行
$status = $stmt->execute();

//４．データ登録処理後
if ($status === false) {
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit('ErrorMessage:' . $error[2]);
} else {
  //５．index.phpへリダイレクト
  header('Location: endpost.php');
}
