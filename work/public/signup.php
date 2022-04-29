<?php

require_once(__DIR__ . '/../app/UserLogic.php');


$err = [];

// トークン照会
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  validateToken();
}
unset($_SESSION['csrf_token']);

// バリデーション
if (!$name = trim(filter_input(INPUT_POST, 'username'))) {
  $err[] = 'Please enter your username!';
}
// var_dump($name);
if (!$email = trim(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))) {
  $err[] = 'Please enter your Email Address!';
}
// var_dump($email);
if (!$userid = trim(filter_input(INPUT_POST, 'userid'))) {
  $err[] = 'Please enter your ID Name!';
}
// var_dump($userid);
$password = filter_input(INPUT_POST, 'password');
if (!preg_match("/\A[a-z\d]{8,100}+\z/i", $password)) {
  $err[] = 'Please enter the password from 8 to 100 characters!';
}
$password_conf = filter_input(INPUT_POST, 'password_conf');
if ($password !== $password_conf) {
  $err[] = 'Password and confirmation password are defferent!';
}

if (count($err) === 0) {
  $checked = UserLogic::checkUser($_POST);
  if(!empty($checked)) {
    // checkedがtrueだったら同じユーザ名エラー
    $err[] = 'This username is already in use';
  } elseif ($checked === false) {
    // checkedがfalseだったらユーザー登録
    $hasCreated = UserLogic::createUser($_POST);
    if (!$hasCreated) {
      $err[] = 'Registration failed';
    }
  }
}

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
  <form action="signup_form.php" method="post">
    <?php if (count($err) > 0) : ?>
      <?php foreach ($err as $e) : ?>
        <p><?= h($e); ?></p>
      <?php endforeach; ?>
    <button type="submit">Return</button>
  </form>
    <?php else : ?>
    <main>
      <h2>Completion of registration</h2>
      <a href="login_form.php">Please login</a>
    </main>
      <p align="center">Do not press the back or refresh button</p>
</body>
  <?php endif; ?>
</html>