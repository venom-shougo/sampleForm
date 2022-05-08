<?php
require_once(__DIR__ . '/../app/config.php');

Token::setToken();

// ログイン以降に他formに移らない処理
$result = UserLogic::checkLogin();
if ($result) {
  header('Location: mypage.php');
  return;
}

// mypage.phpエラー処理、三項演算子分岐
$login_err = isset($_SESSION['login_err']) ? $_SESSION['login_err'] : null;
unset($_SESSION['login_err']);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signin</title>
</head>
<body>
  <h2>New Member Page</h2>
  <?php if (isset($login_err)) : ?>
    <p><?= Utils::h($login_err); ?></p>
  <?php endif; ?>
  <form action="signup.php" method="post">
    <input type="text" name="username" placeholder="UserName"><br>
    <input type="email" name="email" placeholder="Email"><br>
    <input type="text" name="userid" placeholder="ID Name"><br>
    <input type="password" name="password" placeholder="Password"><br>
    <input type="password" name="password_conf" placeholder="Password Conf"><br>
    <input type="hidden" name="csrf_token" value="<?= Utils::h($_SESSION["csrf_token"]); ?>">
    <button type="submit">Signin</button>
  </form>
  <a href="login_form.php">Login Page</a>
</body>
</html>

