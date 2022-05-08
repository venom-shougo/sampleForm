<?php

require_once(__DIR__ . '/../app/config.php');

// ポスト値が空だったらエラー出力
if (!$logout = filter_input(INPUT_POST, 'logout')) {
  exit('Invalid post request');
}

// ログイン判定、セッション切れ、ログイン要求
// セッション有効期限はデフォルトで24分
// MyPageで何もしなかったらセッションが切れる
$result = UserLogic::checkLogin();
if (!$result) {
  $err = 'Expired,please log in again' . "\n" . '<a href="login_form.php">Login Page</a>';
  $err = nl2br($err);
  exit($err);
}

// ログアウト処理
UserLogic::logout();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LogOut</title>
  <body>
    <h2>Logout completed!</h2>
    <a href="login_form.php">Login Page</a>
  </body>
</head>
</html>