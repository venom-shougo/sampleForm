<?php

require_once(__DIR__ . '/../app/config.php');

// ログイン中合否判定、丕は新規画面へ
$result = UserLogic::checkLogin();

if (!$result) {
  $_SESSION['login_err'] = 'Please register as a user and log in!';
  header('Location: signup_form.php');
  return;
}
$login_user = $_SESSION['login_user'];


?>

<!DOCTYPE html>
<html lang=""ja>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MyPage</title>
</head>
<body>
  <h2>MyPage</h2>
    <p>User : <?= Utils::h($login_user['username']); ?></p><br>
    <p>User : <?= Utils::h($login_user['address']); ?></p><br>
  <form action="logout.php" method="post">
    <input type="submit" name="logout" value="LogOut">
  </form>
  <form action="deleteuser.php" method="post">
    <input type="submit" name="deleteuser" value="WithDrawal">
  </form>
</body>
</html>