<?php

//最初にSESSIONを開始！！ココ大事！！
session_start();

//1. POSTデータ取得
$loginID = $_POST['login_id'];
$loginPW = $_POST['login_pw'];
$displayName = $_POST['display_name'];

//2. DB接続します
require_once('funcs.php');
$pdo = db_conn();

//３．データ登録SQL作成
$sql = "INSERT INTO user_table(login_id,login_pw,display_name,signup_date)VALUES(:login_id,:login_pw,:display_name, CURRENT_TIMESTAMP);";
// $stmt = $pdo->prepare('INSERT INTO user_table(login_id,login_pw,display_name,signup_date)VALUES(:login_id,:login_pw,:display_name,sysdate());');
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':login_id', $loginID, PDO::PARAM_STR);
$stmt->bindValue(':login_pw', $loginPW, PDO::PARAM_STR);
$stmt->bindValue(':display_name', $displayName, PDO::PARAM_STR);
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status == false) {
    sql_error($stmt);
    echo 'sql failure';
    echo $loginID;
    echo $loginPW;
    echo $displayName;
} else {
    redirect('endsignup.php');
}

exit();
