<?php

require_once(__DIR__ . '/../app/config.php');

// ログイン以降に他formに移らない処理
$result = UserLogic::checkLogin();
if ($result) {
  header('Location: mypage.php');
  return;
}

// ログインバリデーションエラーの処理
$err = $_SESSION;
$_SESSION = array();
session_destroy();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LoginForm</title>
</head>
<body>
<h2>Login Page</h2>
    <?php if (isset($err['message'])) : ?>
      <p><?= Utils::h($err['message']); ?></p>
    <?php endif; ?>
  <form action="login.php" method="post">
    <input type="text" name="userid" placeholder="ID Name"><br>
      <?php if (isset($err['userid'])) : ?>
        <p><?= Utils::h($err['userid']); ?></p>
      <?php endif; ?>
    <input type="password" name="password" placeholder="Password"><br>
      <?php if (isset($err['password'])) : ?>
        <p><?= Utils::h($err['password']);?></p>
      <?php endif; ?>
    <button type="submit">Login</button>
  </form>
    <a href="signup_form.php">Click here for new registration</a>
</body>
</html>