<?php

require_once(__DIR__ . '/../app/config.php');

// トークン照会
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  Token::validateToken();
}
unset($_SESSION['csrf_token']);

$err = [];

// サインアップフォームバリデーション
$validate = ValidateForm::setSignup($_POST);
$err = $validate;
// var_dump($err);
// exit;
// エラー無しで同ユーザチェック
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
        <p><?= Utils::h($e); ?></p>
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