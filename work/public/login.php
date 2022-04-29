<?php

require_once(__DIR__ . '/../app/UserLogic.php');

$err = [];

// バリデーション
if (!$userid = trim(filter_input(INPUT_POST, 'userid'))) {
  $err['userid'] = 'Please enter your ID Name!';
}

if (!$password = trim(filter_input(INPUT_POST, 'password'))) {
  $err['password'] = 'Password is incorrect!';
}

// エラーカウント
if (count($err) > 0) {
  $_SESSION = $err;
  header('Location: login_form.php');
  return;
}
// ログイン成功処理
$result = UserLogic::login($userid, $password);

// ログイン失敗処理
if (!$result) {
  header('Location: login_form.php');
  return;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Refresh" content="3; url=http://localhost:8560/mypage.php">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login completed</title>
</head>
<body>
  <main>
    <?php if (count($err) > 0) : ?>
      <?php foreach ($err as $e) : ?>
        <p><?= h($e); ?></p>
      <?php endforeach; ?>
    <?php else : ?>
      <p>Login completed!</p>
    <?php endif; ?>
    <a href="mypage.php">MyPage</a>
  </main>
</body>
</html>