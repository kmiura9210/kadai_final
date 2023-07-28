<?php
session_start();
require_once('funcs.php');
loginCheck();



$id = $_GET['id'];

try {
    $db_name = 'ej_db'; //データベース名
    $db_id   = 'root'; //アカウント名
    $db_pw   = ''; //パスワード：MAMPは'root'
    $db_host = 'localhost'; //DBホスト
    $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
} catch (PDOException $e) {
    exit('DB Connection Error:' . $e->getMessage());
}

//３．データ登録SQL作成
$stmt = $pdo->prepare('DELETE FROM article_table WHERE id = :id;');

// 数値の場合 PDO::PARAM_INT
// 文字の場合 PDO::PARAM_STR
// $stmt->bindValue(':name', $name, PDO::PARAM_STR);
// $stmt->bindValue(':email', $email, PDO::PARAM_STR);
// $stmt->bindValue(':age', $age, PDO::PARAM_INT);
$stmt->bindValue(':id', $id, PDO::PARAM_INT); //PARAM_INTなので注意
// $stmt->bindValue(':content', $content, PDO::PARAM_STR);
$status = $stmt->execute(); //実行

if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    header('Location: select.php');
    // exit();
}