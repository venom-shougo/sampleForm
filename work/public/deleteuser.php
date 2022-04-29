<?php

require_once(__DIR__ . '/../app/UserLogic.php');

$err = [];

// ポスト値が空だったらエラー出力
if (!$deleteuser = filter_input(INPUT_POST, 'deleteuser')) {
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

// 退会処理
$deleteuser = UserLogic::deleteuser();
if (!$deleteuser) {
  $err[] = 'Withdrawal failure';
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Withdrawal</title>
  <body>
    <?php if (count($err) > 0) : ?>
      <?php foreach ($err as $e) : ?>
        <?= h($e); ?>
      <?php endforeach; ?>
    <?php else : ?>
      <h2>Withdrawal Screen</h2>
      <p>Withdrawal completed!</p>
    <?php endif; ?>
    <a href="signup_form.php">Click here for new registration</a>
  </body>
</head>
</html>